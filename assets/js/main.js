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
