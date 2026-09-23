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
<section class="section food-section" id="eten" aria-labelledby="food-heading">
  <div class="section-title reveal">
    <p class="eyebrow">04 / Pasta &amp; snacks</p>
    <h2 id="food-heading">Iets kleins, iets warms of gewoon iets gezellig om te delen.</h2>
    <p>Van pasta tot croques en warme snacks: ideaal voor een snelle hap, een gezellige avond of iets om samen te delen.</p>
  </div>

  <div class="food-grid">
    <?php $foodCategoryIndex = 0; ?>
    <?php foreach ($foodItems as $category => $items): ?>
      <?php $foodCategoryIndex++; ?>
      <article class="food-card reveal" aria-labelledby="food-category-<?= $foodCategoryIndex ?>">
        <div class="food-card-heading">
          <span class="food-category-number" aria-hidden="true"><?= sprintf('%02d', $foodCategoryIndex) ?></span>
          <svg class="food-card-mark" width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true" focusable="false"><circle cx="16" cy="16" r="11" stroke="currentColor" stroke-width="1.3"/><circle cx="16" cy="16" r="7" stroke="currentColor" stroke-width="1.3"/><path d="M16 1v4M16 27v4M1 16h4M27 16h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
        </div>
        <h3 id="food-category-<?= $foodCategoryIndex ?>"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></h3>
        <ul class="food-list">
          <?php foreach ($items as $item): ?>
            <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>

  <aside class="food-note reveal" aria-label="Goed om te weten bij de eetkaart">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 11v6M12 7v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    <p>Vraag gerust naar onze suggesties. Gelieve allergieën vooraf te melden.</p>
  </aside>
</section>
