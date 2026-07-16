<?php
$foodItems = [
  'Pasta' => [
    'Pasta Bolognese',
    'Pasta Carbonara',
  ],
  'Snacks' => [
    'Buitengewone Croque enkel',
    'Buitengewone Croque dubbel',
    'Mozzarella bites',
    'Bitterballen',
    'Warm gemengd',
    'Kippenboutjes',
    'Pinsa pizza',
  ],
  'Chips' => [
    'Chips zout',
    'Chips paprika',
    'Chips peper en zout',
    'Chips Thai curry explosions',
  ],
];
?>
<section class="section food-section" id="eten">
  <div class="section-title reveal">
    <p class="eyebrow">Pasta & snacks</p>
    <h2>Iets kleins, iets warms of gewoon iets gezellig om te delen.</h2>
    <p>Van pasta tot croques en warme snacks: ideaal voor een snelle hap, een gezellige avond of iets om samen te delen.</p>
  </div>

  <div class="food-grid">
    <?php foreach ($foodItems as $category => $items): ?>
      <article class="food-card reveal">
        <h3><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></h3>
        <ul class="food-list">
          <?php foreach ($items as $item): ?>
            <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="food-note reveal">
    <p>Vraag gerust naar onze suggesties. Gelieve allergieën vooraf te melden.</p>
  </div>
</section>
