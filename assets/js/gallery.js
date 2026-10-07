(() => {
  'use strict';

  // Photo links keep working normally if this progressive enhancement is unavailable.
  const dialog = document.querySelector('.gallery-dialog');
  const photos = [...document.querySelectorAll('a[data-gallery]')]
    .filter(link => link.querySelector('img'));
  if (!dialog || typeof dialog.showModal !== 'function' || !photos.length) return;

  const image = dialog.querySelector('.gallery-dialog-image');
  const caption = dialog.querySelector('.gallery-dialog-caption');
  const status = dialog.querySelector('.gallery-status');
  const close = dialog.querySelector('.gallery-close');
  const previous = dialog.querySelector('.gallery-previous');
  const next = dialog.querySelector('.gallery-next');
  const strip = dialog.querySelector('.gallery-thumbnails');
  const hint = dialog.querySelector('.gallery-gesture-hint');
  if (!image || !caption || !status || !close || !previous || !next) return;

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const coarsePointer = window.matchMedia('(pointer: coarse)');
  const entries = photos.map(link => {
    const thumbnail = link.querySelector('img');
    const sources = (thumbnail.getAttribute('srcset') || '').split(',')
      .map(source => source.trim().split(/\s+/))
      .filter(([url, width]) => url && /^\d+w$/.test(width || ''))
      .map(([url, width]) => ({ url, width: parseInt(width, 10) }))
      .sort((a, b) => a.width - b.width);
    const optimized = sources.filter(source => /\/optimized\//.test(source.url));
    return {
      link,
      thumbnail,
      small: (optimized.find(source => source.width === 480) || optimized[0])?.url || thumbnail.src,
      // Use an existing WebP rather than downloading the multi-megabyte original.
      large: optimized[optimized.length - 1]?.url || link.href,
      adjacent: optimized.find(source => source.width === 960)?.url || null,
      description: thumbnail.alt || 'Sfeerfoto van De Pasto'
    };
  });

  let current = 0;
  let request = 0;
  let opener = null;
  let previousOverflow = '';
  let idle = null;
  let thumbnails = [];
  let swipe = null;
  const pointers = new Set();
  const prefetched = new Set();
  const wrap = index => ((index % entries.length) + entries.length) % entries.length;

  const cancelPrefetch = () => {
    if (idle === null) return;
    if ('cancelIdleCallback' in window) window.cancelIdleCallback(idle);
    else window.clearTimeout(idle);
    idle = null;
  };

  const prefetchAdjacent = token => {
    cancelPrefetch();
    const connection = navigator.connection;
    if (connection?.saveData || /(^|-)2g$/.test(connection?.effectiveType || '')) return;
    const load = () => {
      idle = null;
      if (!dialog.open || request !== token) return;
      [wrap(current - 1), wrap(current + 1)].forEach(index => {
        const url = entries[index].adjacent;
        if (!url || index === current || prefetched.has(url)) return;
        prefetched.add(url);
        const preview = new Image();
        preview.decoding = 'async';
        preview.src = url;
      });
    };
    idle = 'requestIdleCallback' in window
      ? window.requestIdleCallback(load, { timeout: 900 })
      : window.setTimeout(load, 180);
  };

  const updateThumbnails = () => {
    thumbnails.forEach((button, index) => {
      const selected = index === current;
      button.setAttribute('aria-pressed', String(selected));
      button.tabIndex = selected ? 0 : -1;
    });
    if (!strip || !thumbnails[current]) return;
    // Move only the strip: scrollIntoView could also move the dialog or underlying page.
    const selected = thumbnails[current];
    const stripBounds = strip.getBoundingClientRect();
    const selectedBounds = selected.getBoundingClientRect();
    const delta = selectedBounds.left < stripBounds.left
      ? selectedBounds.left - stripBounds.left - 4
      : selectedBounds.right > stripBounds.right
        ? selectedBounds.right - stripBounds.right + 4 : 0;
    if (delta) strip.scrollTo({
      left: strip.scrollLeft + delta,
      behavior: reducedMotion.matches ? 'instant' : 'smooth'
    });
  };

  const showPhoto = async index => {
    if (!dialog.open) return;
    current = wrap(index);
    const token = ++request;
    const entry = entries[current];
    const fallback = entry.thumbnail.currentSrc || entry.thumbnail.src;
    image.src = fallback;
    image.alt = entry.description;
    caption.textContent = entry.description;
    status.textContent = 'Foto ' + (current + 1) + ' van ' + entries.length;
    const description = document.createElement('span');
    description.className = 'visually-hidden';
    description.textContent = ': ' + entry.description;
    status.appendChild(description);
    updateThumbnails();
    prefetchAdjacent(token);

    const full = new Image();
    full.decoding = 'async';
    full.src = entry.large;
    try {
      await full.decode();
      if (token === request && dialog.open) image.src = full.src;
    } catch {
      // A failed larger copy must neither blank the photo nor overwrite a later selection.
      if (token === request && dialog.open) status.appendChild(document.createTextNode(' — kleinere weergave'));
    }
  };

  const prepareThumbnails = () => {
    if (!strip || thumbnails.length) return;
    const fragment = document.createDocumentFragment();
    thumbnails = entries.map((entry, index) => {
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'gallery-thumbnail';
      button.setAttribute('aria-label', 'Bekijk foto ' + (index + 1) + ': ' + entry.description);
      button.setAttribute('aria-pressed', 'false');
      const preview = document.createElement('img');
      preview.src = entry.small;
      preview.alt = '';
      preview.width = 56;
      preview.height = 56;
      preview.loading = 'lazy';
      preview.decoding = 'async';
      button.appendChild(preview);
      button.addEventListener('click', () => showPhoto(index));
      fragment.appendChild(button);
      return button;
    });
    strip.appendChild(fragment);
    strip.hidden = entries.length < 2;
  };

  const updateHint = () => {
    if (hint) hint.hidden = entries.length < 2 || !coarsePointer.matches;
  };
  updateHint();
  coarsePointer.addEventListener('change', updateHint);
  previous.disabled = next.disabled = entries.length < 2;

  photos.forEach((link, index) => link.addEventListener('click', event => {
    if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    try { dialog.showModal(); } catch { return; }
    event.preventDefault();
    opener = link;
    previousOverflow = document.documentElement.style.overflow;
    document.documentElement.style.overflow = 'hidden';
    prepareThumbnails();
    showPhoto(index);
    close.focus({ preventScroll: true });
  }));

  close.addEventListener('click', () => dialog.close());
  previous.addEventListener('click', () => showPhoto(current - 1));
  next.addEventListener('click', () => showPhoto(current + 1));
  dialog.addEventListener('keydown', event => {
    if (event.metaKey || event.ctrlKey || event.altKey || event.shiftKey) return;
    if (event.target.closest('input, textarea, select, [contenteditable="true"]')) return;
    let index;
    if (event.key === 'ArrowLeft') index = current - 1;
    else if (event.key === 'ArrowRight') index = current + 1;
    else if (event.key === 'Home') index = 0;
    else if (event.key === 'End') index = entries.length - 1;
    else return;
    event.preventDefault();
    const fromThumbnail = event.target.closest('.gallery-thumbnail');
    showPhoto(index);
    if (fromThumbnail) thumbnails[current]?.focus({ preventScroll: true });
  });

  // Passive handlers leave vertical scrolling and pinch zoom to the browser.
  image.addEventListener('pointerdown', event => {
    if (event.pointerType !== 'touch' && event.pointerType !== 'pen') return;
    pointers.add(event.pointerId);
    if (pointers.size > 1 || !event.isPrimary) { swipe = null; return; }
    swipe = { id: event.pointerId, x: event.clientX, y: event.clientY, started: event.timeStamp };
  }, { passive: true });
  image.addEventListener('pointerup', event => {
    const gesture = swipe;
    pointers.delete(event.pointerId);
    swipe = null;
    if (!gesture || gesture.id !== event.pointerId || pointers.size || !dialog.open) return;
    const horizontal = event.clientX - gesture.x;
    const vertical = event.clientY - gesture.y;
    if (Math.abs(horizontal) >= 50 && Math.abs(horizontal) > Math.abs(vertical) * 1.5
      && event.timeStamp - gesture.started < 1200) {
      showPhoto(current + (horizontal < 0 ? 1 : -1));
    }
  }, { passive: true });
  image.addEventListener('pointercancel', event => {
    pointers.delete(event.pointerId);
    swipe = null;
  }, { passive: true });

  // Escape, focus containment and inert background content come from the native dialog.
  dialog.addEventListener('close', () => {
    request++;
    cancelPrefetch();
    swipe = null;
    pointers.clear();
    document.documentElement.style.overflow = previousOverflow;
    if (opener?.isConnected) opener.focus({ preventScroll: true });
  });
  dialog.addEventListener('click', event => {
    const rect = dialog.getBoundingClientRect();
    if (event.target === dialog && (event.clientX < rect.left || event.clientX > rect.right
      || event.clientY < rect.top || event.clientY > rect.bottom)) dialog.close();
  });
})();
