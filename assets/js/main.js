(() => {
  'use strict';

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const header = document.querySelector('.site-header');
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.site-nav');
  const mobileNav = window.matchMedia('(max-width: 900px)');

  if (header && toggle && nav) {
    const closeMenu = (restoreFocus = false) => {
      nav.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Menu openen');
      if (restoreFocus) toggle.focus();
    };
    toggle.hidden = false;
    header.classList.add('nav-enhanced');
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Menu sluiten' : 'Menu openen');
    });
    nav.addEventListener('click', event => {
      if (event.target.closest('a')) closeMenu();
    });
    document.addEventListener('keydown', event => {
      if (event.key === 'Escape' && nav.classList.contains('open')) closeMenu(true);
    });
    document.addEventListener('click', event => {
      if (!header.contains(event.target)) closeMenu();
    });
    header.addEventListener('focusout', event => {
      if (event.relatedTarget && !header.contains(event.relatedTarget)) closeMenu();
    });
    mobileNav.addEventListener('change', () => closeMenu());

    const links = [...nav.querySelectorAll('a[href^="#"]:not(.nav-reservation)')];
    const sections = links.map(link => document.querySelector(link.hash));
    let pending = false;
    const updateActiveLink = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
      let current = -1;
      sections.forEach((section, index) => {
        if (section && section.getBoundingClientRect().top <= header.offsetHeight + 140) current = index;
      });
      links.forEach((link, index) => {
        if (index === current) link.setAttribute('aria-current', 'location');
        else link.removeAttribute('aria-current');
      });
      pending = false;
    };
    window.addEventListener('scroll', () => {
      if (!pending) {
        pending = true;
        window.requestAnimationFrame(updateActiveLink);
      }
    }, { passive: true });
    window.addEventListener('resize', updateActiveLink);
    updateActiveLink();
  }

  // Never hide content in CSS: an unavailable observer or failed script stays readable.
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        if (!reducedMotion.matches) entry.target.classList.add('is-revealing');
        revealObserver.unobserve(entry.target);
      });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(element => {
      revealObserver.observe(element);
      element.addEventListener('animationend', () => element.classList.remove('is-revealing'), { once: true });
    });
  }


  const hero = document.querySelector('.hero');
  const slides = [...document.querySelectorAll('.hero-media img')];
  const controls = document.querySelector('.hero-controls');
  const sliderToggle = document.querySelector('.slider-toggle');
  const sliderPrev = document.querySelector('.slider-prev');
  const sliderNext = document.querySelector('.slider-next');
  const counter = document.querySelector('.slide-counter');
  const slideCaption = document.querySelector('.slide-caption');
  if (hero && slides.length > 1 && controls && sliderToggle && counter) {
    let current = 0;
    let requested = 0;
    let paused = false;
    let hovering = false;
    let visible = true;
    let loading = false;
    let requestToken = 0;
    let timer;
    const canPlay = () => !paused && !hovering && !reducedMotion.matches && visible &&
      !document.hidden && !hero.contains(document.activeElement);
    const updateInfo = () => {
      counter.textContent = String(current + 1).padStart(2, '0') + ' / ' + String(slides.length).padStart(2, '0');
      if (slideCaption) slideCaption.textContent = slides[current].dataset.caption || '';
    };
    const schedule = () => {
      window.clearTimeout(timer);
      if (canPlay() && !loading) timer = window.setTimeout(() => showSlide(current + 1), 7000);
    };
    const showSlide = async (index, manual = false) => {
      if (!manual && !canPlay()) return;
      const target = ((index % slides.length) + slides.length) % slides.length;
      const token = ++requestToken;
      requested = target;
      window.clearTimeout(timer);
      if (target === current) { loading = false; schedule(); return; }
      loading = true;
      const image = slides[target];
      try {
        if (image.dataset.src) {
          if (image.dataset.srcset) image.srcset = image.dataset.srcset;
          image.src = image.dataset.src;
          delete image.dataset.src;
          delete image.dataset.srcset;
        }
        await image.decode();
        if (token !== requestToken) return;
        if (!manual && !canPlay()) { requested = current; return; }
        slides[current].classList.remove('is-active');
        image.classList.add('is-active');
        current = target;
        requested = current;
        updateInfo();
        const announcement = controls.querySelector('[data-hero-status]');
        if (manual && announcement) {
          announcement.textContent = 'Foto ' + (current + 1) + ' van ' + slides.length + ': ' + (image.dataset.caption || '');
        }
      } catch {
        if (token === requestToken) requested = current;
      } finally {
        if (token === requestToken) { loading = false; schedule(); }
      }
    };
    if (sliderPrev) sliderPrev.addEventListener('click', () => showSlide(requested - 1, true));
    if (sliderNext) sliderNext.addEventListener('click', () => showSlide(requested + 1, true));
    sliderToggle.addEventListener('click', () => {
      paused = !paused;
      sliderToggle.setAttribute('aria-pressed', String(paused));
      sliderToggle.setAttribute('aria-label', paused ? 'Fotoslider hervatten' : 'Fotoslider pauzeren');
      if (sliderToggle.firstElementChild) sliderToggle.firstElementChild.textContent = paused ? '▶' : 'Ⅱ';
      schedule();
    });
    hero.addEventListener('focusin', schedule);
    hero.addEventListener('focusout', () => window.requestAnimationFrame(schedule));
    hero.addEventListener('pointerenter', event => {
      if (event.pointerType === 'mouse') { hovering = true; schedule(); }
    });
    hero.addEventListener('pointerleave', event => {
      if (event.pointerType === 'mouse') { hovering = false; schedule(); }
    });
    controls.addEventListener('keydown', event => {
      if (event.metaKey || event.ctrlKey || event.altKey || event.shiftKey) return;
      if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
        event.preventDefault();
        showSlide(requested + (event.key === 'ArrowLeft' ? -1 : 1), true);
      }
    });
    const media = hero.querySelector('.hero-media');
    if (media) {
      let gesture = null;
      media.addEventListener('pointerdown', event => {
        if (event.pointerType !== 'touch') return;
        if (!event.isPrimary) { gesture = null; return; }
        gesture = { id: event.pointerId, x: event.clientX, y: event.clientY };
      }, { passive: true });
      media.addEventListener('pointercancel', () => { gesture = null; }, { passive: true });
      media.addEventListener('pointerup', event => {
        if (!gesture || event.pointerId !== gesture.id) return;
        const dx = event.clientX - gesture.x;
        const dy = event.clientY - gesture.y;
        gesture = null;
        if (Math.abs(dx) > 55 && Math.abs(dx) > Math.abs(dy) * 1.5) {
          showSlide(requested + (dx < 0 ? 1 : -1), true);
        }
      }, { passive: true });
    }
    const updateMotion = () => {
      controls.hidden = false;
      sliderToggle.hidden = reducedMotion.matches;
      schedule();
    };
    reducedMotion.addEventListener('change', updateMotion);
    document.addEventListener('visibilitychange', schedule);
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(entries => {
        visible = entries[0].isIntersecting;
        schedule();
      }).observe(hero);
    }
    updateInfo();
    updateMotion();
  }

  // Highlight the calendar day in Belgium without guessing whether the café is open.
  const highlightToday = () => {
    const weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const day = new Intl.DateTimeFormat('en-GB', { weekday: 'short', timeZone: 'Europe/Brussels' }).format(new Date());
    document.querySelectorAll('[data-weekday]').forEach(row => {
      const today = Number(row.dataset.weekday) === weekdays.indexOf(day) + 1;
      row.classList.toggle('is-today', today);
      const label = row.querySelector('.today-label');
      if (label && !today) label.remove();
      if (today && !label) {
        const badge = document.createElement('span');
        badge.className = 'today-label';
        badge.textContent = 'Vandaag';
        row.querySelector('dt').appendChild(badge);
      }
    });
  };
  highlightToday();
  document.addEventListener('visibilitychange', () => { if (!document.hidden) highlightToday(); });

  // Reservation links choose the subject without changing anything already typed.
  const topic = document.querySelector('#contact-topic');
  if (topic) {
    document.querySelectorAll('[data-contact-intent]').forEach(link => {
      link.addEventListener('click', event => {
        if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
        if ([...topic.options].some(option => option.value === link.dataset.contactIntent)) {
          topic.value = link.dataset.contactIntent;
          topic.dispatchEvent(new Event('change', { bubbles: true }));
        }
      });
    });
  }

  // Moment cards lead directly to the matching category; anchors still work without JS.
  const drinksSearch = document.querySelector('#drinks-search');
  if (drinksSearch) {
    document.querySelectorAll('[data-drink-query]').forEach(link => {
      link.addEventListener('click', event => {
        if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
        drinksSearch.value = link.dataset.drinkQuery;
        drinksSearch.dispatchEvent(new Event('input', { bubbles: true }));
      });
    });
  }

  const feedback = document.querySelector('[data-form-feedback]');
  if (feedback) {
    window.addEventListener('load', () => {
      window.requestAnimationFrame(() => {
        feedback.focus({ preventScroll: true });
        feedback.scrollIntoView({ block: 'center', behavior: 'instant' });
      });
    }, { once: true });
  }
})();
