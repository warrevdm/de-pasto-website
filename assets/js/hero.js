(() => {
  'use strict';

  // The first scene and its link remain usable when this enhancement is unavailable.
  const hero = document.querySelector('.hero-experience');
  if (!hero) return;
  const media = hero.querySelector('.hero-scene-media');
  const controls = hero.querySelector('[data-hero-controls]');
  const title = hero.querySelector('[data-hero-scene-title]');
  const description = hero.querySelector('[data-hero-scene-description]');
  const link = hero.querySelector('[data-hero-scene-link]');
  const linkLabel = link?.querySelector('[data-hero-link-label]');
  const status = hero.querySelector('[data-hero-status]');
  const scenes = [...hero.querySelectorAll('[data-hero-scene]')].map(element => ({
    element,
    image: element.querySelector('img'),
    id: element.dataset.heroScene,
    title: element.dataset.title,
    description: element.dataset.description,
    link: element.dataset.link,
    linkLabel: element.dataset.linkLabel,
    query: element.dataset.query || ''
  }));
  const buttons = [...hero.querySelectorAll('[data-hero-choice]')];
  if (!media || !controls || !title || !description || !link || !status || scenes.length < 2
    || scenes.some(scene => !scene.image || !scene.id || !scene.title || !scene.description || !scene.link || !scene.linkLabel)
    || new Set(scenes.map(scene => scene.id)).size !== scenes.length
    || buttons.length !== scenes.length
    || new Set(buttons.map(button => button.dataset.heroChoice)).size !== buttons.length
    || buttons.some(button => !scenes.some(scene => scene.id === button.dataset.heroChoice))) return;

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
  const drinksSearch = document.querySelector('#drinks-search');
  const initialized = new WeakSet();
  const pointers = new Set();
  let current = Math.max(0, scenes.findIndex(scene => scene.element.classList.contains('is-active')));
  let requested = current;
  let request = 0;
  let loading = false;
  let gesture = null;
  let visible = false;
  let frame = null;
  let parallaxX = 0;
  let parallaxY = 0;
  const wrap = index => ((index % scenes.length) + scenes.length) % scenes.length;

  const updateScene = () => {
    const scene = scenes[current];
    scenes.forEach((entry, index) => {
      entry.element.classList.toggle('is-active', index === current);
      entry.element.setAttribute('aria-hidden', 'true');
    });
    buttons.forEach(button => button.setAttribute('aria-pressed', String(button.dataset.heroChoice === scene.id)));
    title.textContent = scene.title;
    description.textContent = scene.description;
    link.setAttribute('href', scene.link);
    (linkLabel || link).textContent = scene.linkLabel;
  };

  const decodeImage = image => {
    if (typeof image.decode === 'function') return image.decode();
    if (image.complete) return image.naturalWidth > 0 ? Promise.resolve() : Promise.reject(new Error('Image unavailable'));
    return new Promise((resolve, reject) => {
      const finish = success => {
        image.removeEventListener('load', loaded);
        image.removeEventListener('error', failed);
        if (success && image.naturalWidth > 0) resolve();
        else reject(new Error('Image unavailable'));
      };
      const loaded = () => finish(true);
      const failed = () => finish(false);
      image.addEventListener('load', loaded, { once: true });
      image.addEventListener('error', failed, { once: true });
    });
  };

  const selectScene = async index => {
    const next = wrap(index);
    // A repeated tap on the same pending scene must not start another decode.
    if (loading && requested === next) return;
    const token = ++request;
    requested = next;
    if (next === current) {
      loading = false;
      media.removeAttribute('aria-busy');
      status.textContent = '';
      return;
    }
    loading = true;
    media.setAttribute('aria-busy', 'true');
    const scene = scenes[next];
    const image = scene.image;
    try {
      // Only an explicit choice hydrates another photo; there is no slideshow or prefetch.
      if (!initialized.has(image)) {
        if (image.dataset.srcset) image.srcset = image.dataset.srcset;
        if (image.dataset.src) image.src = image.dataset.src;
        initialized.add(image);
      }
      await decodeImage(image);
      if (token !== request) return;
      if (!image.naturalWidth) throw new Error('Image unavailable');
      current = next;
      updateScene();
      status.textContent = scene.title + '. ' + scene.description;
    } catch {
      if (token !== request) return;
      initialized.delete(image);
      requested = current;
      status.textContent = 'Deze sfeerfoto kon niet laden. Kies opnieuw of probeer een ander moment.';
    } finally {
      if (token === request) {
        loading = false;
        media.removeAttribute('aria-busy');
      }
    }
  };

  buttons.forEach(button => {
    const index = scenes.findIndex(scene => scene.id === button.dataset.heroChoice);
    button.addEventListener('click', () => selectScene(index));
    button.addEventListener('keydown', event => {
      if (event.metaKey || event.ctrlKey || event.altKey || event.shiftKey) return;
      let next;
      if (event.key === 'ArrowLeft') next = wrap(index - 1);
      else if (event.key === 'ArrowRight') next = wrap(index + 1);
      else if (event.key === 'Home') next = 0;
      else if (event.key === 'End') next = scenes.length - 1;
      else return;
      event.preventDefault();
      const nextButton = buttons.find(choice => choice.dataset.heroChoice === scenes[next].id);
      nextButton.focus({ preventScroll: true });
      selectScene(next);
    });
  });

  // Keep normal navigation and modified clicks; the optional scene query only prepares the card.
  link.addEventListener('click', event => {
    if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    const query = scenes[current].query;
    if (!query || !drinksSearch) return;
    drinksSearch.value = query;
    drinksSearch.dispatchEvent(new Event('input', { bubbles: true }));
  });

  // Passive pointer events leave vertical scrolling and pinch zoom to the browser.
  document.addEventListener('pointerdown', event => {
    if (event.pointerType !== 'touch' && event.pointerType !== 'pen') return;
    pointers.add(event.pointerId);
    if (pointers.size > 1) gesture = null;
  }, { capture: true, passive: true });
  media.addEventListener('pointerdown', event => {
    if (event.pointerType !== 'touch' && event.pointerType !== 'pen') return;
    if (!event.isPrimary || pointers.size !== 1 || !visible || document.hidden) {
      gesture = null;
      return;
    }
    gesture = { id: event.pointerId, x: event.clientX, y: event.clientY, started: event.timeStamp };
  }, { passive: true });
  document.addEventListener('pointerup', event => {
    if (event.pointerType !== 'touch' && event.pointerType !== 'pen') return;
    const swipe = gesture;
    pointers.delete(event.pointerId);
    gesture = null;
    if (!swipe || swipe.id !== event.pointerId || pointers.size || !visible || document.hidden) return;
    const horizontal = event.clientX - swipe.x;
    const vertical = event.clientY - swipe.y;
    const elapsed = event.timeStamp - swipe.started;
    if (Math.abs(horizontal) >= 55 && Math.abs(horizontal) > Math.abs(vertical) * 1.5 && elapsed >= 0 && elapsed < 1200) {
      selectScene(requested + (horizontal < 0 ? 1 : -1));
    }
  }, { passive: true });
  document.addEventListener('pointercancel', event => {
    pointers.delete(event.pointerId);
    gesture = null;
  }, { passive: true });

  const resetParallax = () => {
    if (frame !== null) window.cancelAnimationFrame(frame);
    frame = null;
    parallaxX = parallaxY = 0;
    hero.style.setProperty('--hero-x', '0px');
    hero.style.setProperty('--hero-y', '0px');
  };
  const canMove = () => visible && !document.hidden && finePointer.matches && !reducedMotion.matches
    && !hero.contains(document.activeElement);
  const updateVisibility = () => {
    const bounds = hero.getBoundingClientRect();
    visible = bounds.bottom > 0 && bounds.top < window.innerHeight && bounds.right > 0 && bounds.left < window.innerWidth;
    if (!visible) {
      resetParallax();
      gesture = null;
    }
  };
  media.addEventListener('pointermove', event => {
    if (event.pointerType !== 'mouse' || !canMove()) return;
    const bounds = media.getBoundingClientRect();
    if (!bounds.width || !bounds.height) return;
    parallaxX = Math.max(-8, Math.min(8, ((event.clientX - bounds.left) / bounds.width - 0.5) * 16));
    parallaxY = Math.max(-8, Math.min(8, ((event.clientY - bounds.top) / bounds.height - 0.5) * 16));
    if (frame !== null) return;
    frame = window.requestAnimationFrame(() => {
      frame = null;
      if (!canMove()) return;
      hero.style.setProperty('--hero-x', parallaxX.toFixed(2) + 'px');
      hero.style.setProperty('--hero-y', parallaxY.toFixed(2) + 'px');
    });
  }, { passive: true });
  media.addEventListener('pointerleave', resetParallax, { passive: true });
  hero.addEventListener('focusin', resetParallax);
  reducedMotion.addEventListener('change', resetParallax);
  finePointer.addEventListener('change', resetParallax);
  document.addEventListener('visibilitychange', () => {
    resetParallax();
    gesture = null;
    pointers.clear();
    if (!document.hidden) updateVisibility();
  });
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(entries => {
      visible = entries[0].isIntersecting;
      if (!visible) {
        resetParallax();
        gesture = null;
      }
    }).observe(hero);
  } else {
    window.addEventListener('scroll', updateVisibility, { passive: true });
    window.addEventListener('resize', updateVisibility, { passive: true });
  }

  updateScene();
  updateVisibility();
  controls.hidden = false;
})();
