const toggle = document.querySelector('.nav-toggle');
const nav = document.querySelector('.site-nav');

if (toggle && nav) {
  toggle.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    toggle.setAttribute('aria-expanded', String(open));
  });
}

const foodItems = {
  Pasta: [
    'Pasta Bolognese',
    'Pasta Carbonara'
  ],
  'Croques & warme snacks': [
    'Buitengewone Croque',
    'Mozzarella bites',
    'Bitterballen',
    'Warm gemengd',
    'Pinsa pizza',
    'Kippenboutjes'
  ],
  'Voor erbij': [
    'Chips zout',
    'Chips paprika',
    'Chips peper & zout',
    'Chips Thai curry explosions'
  ]
};

const hoursSection = document.querySelector('#uren');

if (hoursSection && !document.querySelector('#eten')) {
  const foodSection = document.createElement('section');
  foodSection.className = 'section food-section';
  foodSection.id = 'eten';

  const cards = Object.entries(foodItems).map(([category, items]) => `
    <article class="food-card reveal">
      <h3>${category}</h3>
      <ul>
        ${items.map(item => `<li>${item}</li>`).join('')}
      </ul>
    </article>
  `).join('');

  foodSection.innerHTML = `
    <div class="section-title reveal">
      <p class="eyebrow">Pasta & snacks</p>
      <h2>Iets klein, iets warm of gewoon veel goesting.</h2>
      <p>Van een dampende pasta tot een snack om te delen. Eenvoudig, gezellig en helemaal De Pasto.</p>
    </div>
    <div class="food-grid">
      ${cards}
    </div>
    <p class="food-suggestion reveal">Vraag gerust naar onze suggesties.</p>
  `;

  hoursSection.parentNode.insertBefore(foodSection, hoursSection);

  if (nav) {
    const hoursLink = nav.querySelector('a[href="#uren"]');
    const foodLink = document.createElement('a');
    foodLink.href = '#eten';
    foodLink.textContent = 'Pasta & snacks';

    if (hoursLink) {
      nav.insertBefore(foodLink, hoursLink);
    } else {
      nav.appendChild(foodLink);
    }
  }
}

if (nav) {
  nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => nav.classList.remove('open'));
  });
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) entry.target.classList.add('visible');
  });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Observeer ook elementen die dynamisch door JavaScript zijn toegevoegd.
document.querySelectorAll('#eten .reveal').forEach(el => observer.observe(el));
