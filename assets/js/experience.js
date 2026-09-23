(() => {
  'use strict';

  // Enhance the server-rendered menu; never rebuild its contents or expose stored prices.
  const section = document.querySelector('.drinks-section');
  if (section) {
    const input = section.querySelector('#drinks-search');
    const toolbar = section.querySelector('.drinks-tools');
    const clear = section.querySelector('.drinks-clear');
    const expand = section.querySelector('.drinks-expand');
    const status = section.querySelector('#drinks-status');
    const empty = section.querySelector('.drinks-empty');
    if (input && toolbar && clear && expand && status && empty) {
      const normalize = value => value.normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '').toLocaleLowerCase('nl-BE')
        .replace(/['’]/g, '').replace(/\s+/g, ' ').trim();
      const cards = [...section.querySelectorAll('.drink-card')].map(card => {
        const category = normalize(card.querySelector('.drink-category-name').textContent);
        const counter = card.querySelector('.drink-category-count');
        return {
          card, counter, originalCount: counter.textContent,
          items: [...card.querySelectorAll('.drink-list li')].map(item => ({
            item, searchable: category + ' ' + normalize(item.textContent)
          }))
        };
      });
      let searching = false;
      const previousOpen = new Map();
      const total = cards.reduce((sum, entry) => sum + entry.items.length, 0);
      const updateExpand = () => {
        const visible = cards.filter(entry => !entry.card.hidden);
        const allOpen = visible.length > 0 && visible.every(entry => entry.card.open);
        expand.disabled = visible.length === 0;
        expand.setAttribute('aria-expanded', String(allOpen));
        expand.textContent = (searching ? 'Resultaten ' : 'Alles ') + (allOpen ? 'inklappen' : 'openklappen');
      };
      const filterDrinks = () => {
        const query = normalize(input.value);
        const terms = query ? query.split(' ') : [];
        const active = terms.length > 0;
        const restore = searching && !active;
        if (active && !searching) cards.forEach(({card}) => previousOpen.set(card, card.open));
        let matches = 0;
        let categories = 0;
        cards.forEach(({card, counter, originalCount, items}) => {
          let count = 0;
          items.forEach(({item, searchable}) => {
            const match = terms.every(term => searchable.includes(term));
            item.hidden = !match;
            if (match) count++;
          });
          card.hidden = count === 0;
          if (active) card.open = count > 0;
          else if (restore) card.open = previousOpen.get(card) || false;
          counter.textContent = active ? count + ' van ' + items.length + ' keuzes' : originalCount;
          matches += count;
          if (count) categories++;
        });
        searching = active;
        clear.hidden = input.value.length === 0;
        empty.hidden = matches !== 0;
        status.textContent = active
          ? matches + ' van ' + total + ' keuzes gevonden in ' + categories + (categories === 1 ? ' categorie.' : ' categorieën.')
          : total + ' keuzes in ' + cards.length + ' categorieën.';
        updateExpand();
      };
      input.addEventListener('input', filterDrinks);
      clear.addEventListener('click', () => { input.value = ''; filterDrinks(); input.focus(); });
      expand.addEventListener('click', () => {
        const visible = cards.filter(entry => !entry.card.hidden);
        const open = !visible.every(entry => entry.card.open);
        visible.forEach(entry => { entry.card.open = open; });
        updateExpand();
      });
      cards.forEach(entry => entry.card.addEventListener('toggle', updateExpand));
      filterDrinks();
      toolbar.hidden = false;
      status.hidden = false;
    }
  }

  // Native links remain a complete fallback if dialog support is unavailable.
  const dialog = document.querySelector('.gallery-dialog');
  const photos = [...document.querySelectorAll('a[data-gallery]')];
  if (dialog && typeof dialog.showModal === 'function' && photos.length) {
    const image = dialog.querySelector('.gallery-dialog-image');
    const caption = dialog.querySelector('.gallery-dialog-caption');
    const status = dialog.querySelector('.gallery-status');
    const close = dialog.querySelector('.gallery-close');
    const previous = dialog.querySelector('.gallery-previous');
    const next = dialog.querySelector('.gallery-next');
    if (!image || !caption || !status || !close || !previous || !next) return;
    let current = 0;
    let request = 0;
    let opener = null;
    let previousOverflow = '';
    const showPhoto = async index => {
      current = ((index % photos.length) + photos.length) % photos.length;
      const token = ++request;
      const link = photos[current];
      const thumbnail = link.querySelector('img');
      const position = current;
      // Display the already-loaded thumbnail while the larger copy decodes.
      image.src = thumbnail.currentSrc || thumbnail.src;
      image.alt = thumbnail.alt;
      caption.textContent = thumbnail.alt;
      status.textContent = 'Foto ' + (position + 1) + ' van ' + photos.length;
      const description = document.createElement('span');
      description.className = 'visually-hidden';
      description.textContent = ': ' + thumbnail.alt;
      status.appendChild(description);
      const full = new Image();
      full.decoding = 'async';
      full.src = link.href;
      try {
        await full.decode();
        if (token === request && dialog.open) image.src = full.src;
      } catch {
        // Keep the thumbnail usable on a slow or failed connection.
        if (token === request && dialog.open) status.appendChild(document.createTextNode(' — kleinere weergave'));
      }
    };
    photos.forEach((link, index) => link.addEventListener('click', event => {
      if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      try { dialog.showModal(); } catch { return; }
      event.preventDefault();
      opener = link;
      previousOverflow = document.documentElement.style.overflow;
      document.documentElement.style.overflow = 'hidden';
      showPhoto(index);
      close.focus();
    }));
    close.addEventListener('click', () => dialog.close());
    previous.addEventListener('click', () => showPhoto(current - 1));
    next.addEventListener('click', () => showPhoto(current + 1));
    dialog.addEventListener('keydown', event => {
      if (event.metaKey || event.ctrlKey || event.altKey || event.shiftKey) return;
      if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
        event.preventDefault();
        showPhoto(current + (event.key === 'ArrowLeft' ? -1 : 1));
      }
    });
    // Escape and focus containment are provided by the native modal dialog.
    dialog.addEventListener('close', () => {
      request++;
      document.documentElement.style.overflow = previousOverflow;
      if (opener && opener.isConnected) opener.focus({ preventScroll: true });
    });
    dialog.addEventListener('click', event => {
      const rect = dialog.getBoundingClientRect();
      if (event.target === dialog && (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom)) dialog.close();
    });
  }
})();
