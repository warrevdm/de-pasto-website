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

    const links = [...nav.querySelectorAll('a[href^="#"]')];
    const sections = links.map(link => document.querySelector(link.hash));
    let pending = false;
    const updateActiveLink = () => {
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
  const counter = document.querySelector('.slide-counter');
  if (hero && slides.length > 1 && controls && sliderToggle && counter) {
    let current = 0;
    let paused = false;
    let visible = true;
    let timer;
    let loading = false;
    const canPlay = () => !paused && !reducedMotion.matches && visible && !document.hidden;
    const schedule = () => {
      window.clearTimeout(timer);
      if (canPlay() && !loading) timer = window.setTimeout(nextSlide, 7000);
    };
    const nextSlide = async () => {
      if (!canPlay()) return;
      const next = (current + 1) % slides.length;
      const image = slides[next];
      loading = true;
      try {
        if (image.dataset.src) {
          image.srcset = image.dataset.srcset;
          image.src = image.dataset.src;
          delete image.dataset.src;
        }
        await image.decode();
        if (canPlay()) {
          slides[current].classList.remove('is-active');
          image.classList.add('is-active');
          current = next;
          counter.textContent = `${String(current + 1).padStart(2, '0')} / ${String(slides.length).padStart(2, '0')}`;
        }
      } catch {
        // Retain the loaded photo if the next image cannot be fetched.
      } finally {
        loading = false;
        schedule();
      }
    };
    sliderToggle.addEventListener('click', () => {
      paused = !paused;
      sliderToggle.setAttribute('aria-pressed', String(paused));
      sliderToggle.setAttribute('aria-label', paused ? 'Fotoslider hervatten' : 'Fotoslider pauzeren');
      sliderToggle.firstElementChild.textContent = paused ? '▶' : 'Ⅱ';
      schedule();
    });
    const updateMotion = () => {
      controls.hidden = reducedMotion.matches;
      schedule();
    };
    reducedMotion.addEventListener('change', updateMotion);
    document.addEventListener('visibilitychange', schedule);
    if ('IntersectionObserver' in window) {
      const heroObserver = new IntersectionObserver(entries => {
        visible = entries[0].isIntersecting;
        schedule();
      });
      heroObserver.observe(hero);
    }
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
