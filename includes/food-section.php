<?php
$foodItems = [
  'Pasta' => [
    'Pasta Bolognese',
    'Pasta Carbonara',
  ],
  'Snacks & iets zoets' => [
    'Buitengewone Croque enkel',
    'Buitengewone Croque dubbel',
    'Mozzarella bites',
    'Bitterballen',
    'Warm gemengd',
    'Pinsa pizza',
    'Pannenkoeken',
    'Suggestie',
  ],
  'Chips' => [
    'Chips zout',
    'Chips paprika',
    'Chips peper en zout',
    'Chips Thai curry explosions',
  ],
];
$foodDescriptions = [
  'Pasta Bolognese' => 'Kleine of grote portie.',
  'Pasta Carbonara' => 'Kleine of grote portie.',
  'Pannenkoeken' => 'Enkel of dubbel.',
];
?>
<section class="section food-section" id="eten" aria-labelledby="food-heading">
  <div class="section-title reveal">
    <p class="eyebrow">Pasta &amp; snacks</p>
    <h2 id="food-heading">Met goesting <em>gemaakt.</em></h2>
    <p>Een bord pasta, een warme croque of iets om te delen. Schuif aan, wij zorgen voor de rest.</p>
  </div>

  <div class="food-grid">
    <?php $foodCategoryIndex = 0; ?>
    <?php foreach ($foodItems as $category => $items): ?>
      <?php $foodCategoryIndex++; ?>
      <article class="food-card reveal" aria-labelledby="food-category-<?= $foodCategoryIndex ?>">
        <div class="food-card-heading">
          <span class="food-category-number" aria-hidden="true"><?= sprintf('%02d', $foodCategoryIndex) ?></span>
          <span class="food-category-rule" aria-hidden="true"></span>
        </div>
        <h3 id="food-category-<?= $foodCategoryIndex ?>"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></h3>
        <ul class="food-list">
          <?php foreach ($items as $item): ?>
            <li>
              <span class="food-name"><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></span>
              <?php if (isset($foodDescriptions[$item])): ?>
                <span class="food-detail"><?= htmlspecialchars($foodDescriptions[$item], ENT_QUOTES, 'UTF-8') ?></span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>

  <aside class="food-note reveal" aria-label="Goed om te weten bij de eetkaart">
    <p><strong>Vraag gerust naar onze suggesties.</strong> Gelieve allergieën vooraf te melden.</p>
  </aside>
</section>
