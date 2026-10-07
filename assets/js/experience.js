(() => {
  'use strict';

  // Enhance the server-rendered menu; its content remains available without JavaScript.
  const section = document.querySelector('.drinks-section');
  if (!section) return;
  const input = section.querySelector('#drinks-search');
  const toolbar = section.querySelector('.drinks-tools');
  const filters = section.querySelector('.drinks-filters');
  const filterButtons = [...section.querySelectorAll('[data-drink-filter]')];
  const clear = section.querySelector('.drinks-clear');
  const expand = section.querySelector('.drinks-expand');
  const share = section.querySelector('.drinks-share');
  const shareFallback = section.querySelector('.drinks-share-fallback');
  const shareInput = section.querySelector('#drinks-share-url');
  const status = section.querySelector('#drinks-status');
  const empty = section.querySelector('.drinks-empty');
  if (!input || !toolbar || !filters || !filterButtons.length || !clear || !expand || !share || !shareFallback || !shareInput || !status || !empty) return;

  const normalize = value => value.normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '').toLocaleLowerCase('nl-BE')
    .replace(/['’]/g, '').replace(/\s+/g, ' ').trim();
  const filterNames = new Map(filterButtons.map(button => [button.dataset.drinkFilter, button.textContent.trim()]));
  const cards = [...section.querySelectorAll('.drink-card')].map(card => {
    const category = normalize(card.querySelector('.drink-category-name').textContent);
    const counter = card.querySelector('.drink-category-count');
    return {
      card, category, counter, originalCount: counter.textContent,
      items: [...card.querySelectorAll('.drink-list li')].map(item => ({
        item,
        searchable: category + ' ' + normalize(item.textContent),
        // Only explicit menu labels and the alcohol-free beer category establish 0.0.
        alcoholFree: category === 'alcoholvrije bieren' || /(^|[^\d])0\.0(?=%|\s|$)/.test(item.querySelector('.drink-name').textContent)
      }))
    };
  });
  let selectedFilter = 'alles';
  let filtering = false;
  let shareRequest = 0;
  const previousOpen = new Map();
  const total = cards.reduce((sum, entry) => sum + entry.items.length, 0);
  const matchesFilter = (category, alcoholFree) => {
    if (selectedFilter === 'koffie') return category === 'warme dranken';
    if (selectedFilter === 'bieren') return ['bieren van t vat', 'bieren op fles', 'alcoholvrije bieren'].includes(category);
    if (selectedFilter === 'apero') return category === 'aperitief';
    if (selectedFilter === 'alcoholvrij') return alcoholFree;
    return true;
  };
  const updateExpand = () => {
    const visible = cards.filter(entry => !entry.card.hidden);
    const allOpen = visible.length > 0 && visible.every(entry => entry.card.open);
    expand.disabled = visible.length === 0;
    expand.setAttribute('aria-expanded', String(allOpen));
    expand.textContent = (filtering ? 'Resultaten ' : 'Alles ') + (allOpen ? 'inklappen' : 'openklappen');
  };
  const filterDrinks = () => {
    input.value = input.value.slice(0, 120);
    const query = normalize(input.value);
    const terms = query ? query.split(' ') : [];
    const active = terms.length > 0 || selectedFilter !== 'alles';
    const restore = filtering && !active;
    if (active && !filtering) cards.forEach(({ card }) => previousOpen.set(card, card.open));
    let matches = 0;
    let categories = 0;
    cards.forEach(({ card, category, counter, originalCount, items }) => {
      let count = 0;
      items.forEach(({ item, searchable, alcoholFree }) => {
        const match = matchesFilter(category, alcoholFree) && terms.every(term => searchable.includes(term));
        item.hidden = !match;
        if (match) count++;
      });
      card.hidden = count === 0;
      if (active) card.open = count > 0;
      else if (restore) card.open = previousOpen.get(card) ?? false;
      counter.textContent = active ? count + ' van ' + items.length + ' keuzes' : originalCount;
      matches += count;
      if (count) categories++;
    });
    filtering = active;
    clear.hidden = input.value.length === 0 && selectedFilter === 'alles';
    empty.hidden = matches !== 0;
    filterButtons.forEach(button => button.setAttribute('aria-pressed', String(button.dataset.drinkFilter === selectedFilter)));
    const prefix = selectedFilter === 'alles' ? '' : filterNames.get(selectedFilter) + ': ';
    status.textContent = active
      ? prefix + matches + ' van ' + total + ' keuzes gevonden in ' + categories + (categories === 1 ? ' categorie.' : ' categorieën.')
      : total + ' keuzes in ' + cards.length + ' categorieën.';
    shareFallback.hidden = true;
    // Ignore a clipboard promise from an older selection after the guest changes filters.
    shareRequest++;
    updateExpand();
  };

  input.addEventListener('input', event => {
    // Existing moment links dispatch input programmatically to pick a category.
    if (!event.isTrusted) selectedFilter = 'alles';
    filterDrinks();
  });
  section.addEventListener('drinks:search', event => {
    if (!event.detail || typeof event.detail.query !== 'string') return;
    input.value = event.detail.query.slice(0, 120);
    selectedFilter = 'alles';
    filterDrinks();
  });
  filterButtons.forEach(button => button.addEventListener('click', () => {
    selectedFilter = filterNames.has(button.dataset.drinkFilter) ? button.dataset.drinkFilter : 'alles';
    filterDrinks();
  }));
  clear.addEventListener('click', () => {
    input.value = '';
    selectedFilter = 'alles';
    filterDrinks();
    input.focus();
  });
  expand.addEventListener('click', () => {
    const visible = cards.filter(entry => !entry.card.hidden);
    const open = !visible.every(entry => entry.card.open);
    visible.forEach(entry => { entry.card.open = open; });
    updateExpand();
  });
  cards.forEach(entry => entry.card.addEventListener('toggle', updateExpand));

  share.addEventListener('click', async () => {
    // Share only the requested menu selection, never unrelated query parameters.
    const url = new URL(window.location.href);
    url.search = '';
    const query = input.value.trim().slice(0, 120);
    if (query) url.searchParams.set('drank', query);
    if (selectedFilter !== 'alles') url.searchParams.set('filter', selectedFilter);
    url.hash = 'dranken';
    const request = ++shareRequest;
    shareFallback.hidden = true;
    try {
      if (!navigator.clipboard || typeof navigator.clipboard.writeText !== 'function') throw new Error('Clipboard unavailable');
      await navigator.clipboard.writeText(url.href);
      if (request === shareRequest) status.textContent = 'Link naar deze selectie gekopieerd.';
    } catch {
      if (request !== shareRequest) return;
      shareInput.value = url.href;
      shareFallback.hidden = false;
      status.textContent = 'Selecteer en kopieer de link hieronder.';
      shareInput.focus();
      shareInput.select();
    }
  });
  shareInput.addEventListener('click', () => shareInput.select());

  const params = new URL(window.location.href).searchParams;
  input.value = (params.get('drank') || input.value || '').slice(0, 120);
  const initialFilter = params.get('filter');
  if (filterNames.has(initialFilter)) selectedFilter = initialFilter;
  filterDrinks();
  toolbar.hidden = false;
  filters.hidden = false;
  status.hidden = false;
})();
