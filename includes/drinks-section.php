<?php
// The current printed menu is the source for this assortment. Prices stay off the website.
$drinks = [
  'Frisdranken' => [
    'Chaudfontaine Plat / Bruis 25cl',
    'Chaudfontaine Plat / Bruis 50cl',
    'Cola / Cola Zero',
    'Fanta',
    'Fuze Tea Sparkling',
    'Fuze Tea Green',
    'Fever-Tree Ginger Ale',
    'Fever-Tree Mediterranean',
    'Red Bull',
    'Almdudler',
    'Schweppes Agrum Zero',
    'Bionade Ginger',
    'Bionade Lemon',
    'Bio Appelsap',
    'Bio Sinaasappelsap',
    'Bio Pompelmoessap',
    'Cécémel',
    'Fristi',
    'Pomton',
  ],
  'Warme dranken' => [
    'Espresso',
    'Dubbele Espresso',
    'Koffie',
    'Koffie Lungo',
    'Koffie verkeerd',
    'Latte Macchiato',
    'Cappuccino',
    'Deca Koffie',
    'Warme Choco',
    'Thee',
    'Verse Munt Thee',
    'Verse Gember Thee',
    'BARÚ Suggestie',
    'Chai Latte',
    'Matcha Latte',
    'Supplement slagroom / siroop',
  ],
  'Bieren van ’t vat' => [
    'Tout Bien 25cl',
    'Tout Bien 33cl',
    'Tout Bien 50cl',
    'Tripel d’Anvers 33cl',
    'Bolleke De Koninck',
    'Liefmans On The Rocks',
    'Wisseltap',
  ],
  'Bieren op fles' => [
    'Duvel',
    'Duvel 666',
    'La Chouffe',
    'Seef',
    'Vedett Extra Blond',
    'Westmalle Dubbel',
    'Westmalle Tripel',
    'Suggestiebier',
    'Salitos Blue',
    'Salitos Ice',
    'Salitos Pink',
  ],
  'Alcoholvrije bieren' => [
    'Vedett Extra Blond 0.0%',
    'Liefmans On The Rocks 0.0%',
    'La Chouffe 0.0%',
    'Suggestiebier',
  ],
  'Sterke dranken' => [
    'Absolut Vodka',
    'Kraken Black Spiced Rum',
    'Bacardi Spiced Rum',
    'Bacardi White Rum',
    'Passoa',
    'Pisang Ambon',
    'Licor 43',
    'J.W. Red Label Whiskey',
    'Amaretto Di Saronno',
  ],
  'Aperitief' => [
    'Aperol Spritz',
    'Mimosa',
    'Limoncello Spritz',
    'Mojito',
    'Mojito 0.0',
    'Porto',
    'Martini Bianco',
    'Martini Rosso',
    'Martini Bellini',
    'Limoncello',
    'Gin & Tonic Copperhead',
    'Gin & Tonic Copperhead 0.0',
    'Gin & Tonic Mare',
  ],
  'Wijn & bubbels' => [
    'Buitengewoon Wit',
    'Buitengewoon Rosé',
    'Buitengewoon Rood',
    'Vache D’Automne Wit',
    'Vache D’Automne Rosé',
    'Vache D’Automne Rood',
    'Chat. Les Fontenelles Zoet',
    'Barrio Cava',
    'Fles Buitengewoon',
    'Fles Vache D’Automne',
    'Fles Chat. Les Fontenelles Zoet',
    'Fles Cava',
  ],
];
$drinkDescriptions = [
  'Warme Choco' => 'Met choco druppels.',
  'Thee' => 'Lipton Classic Earl Grey, Green Tea Sencha, Camomile Linden, Delicate Mint en Rosehip.',
  'Supplement slagroom / siroop' => 'Siropen: caramel en vanille.',
  'Martini Bianco' => 'Spritz it up.',
  'Martini Rosso' => 'Spritz it up.',
];
?>
<section class="section drinks-section" id="dranken" aria-labelledby="drinks-heading">
  <div class="section-title reveal">
    <p class="eyebrow">De drankenkaart</p>
    <h2 id="drinks-heading">Wat mogen we je <em>inschenken?</em></h2>
    <p>Een koffie om even te landen. Een frisse pint, een aperitief of een glas wijn om wat langer te blijven.</p>
  </div>

  <p class="drinks-hint">Open een categorie en ontdek wat we schenken.</p>
  <div class="drinks-tools" hidden>
    <div class="drinks-search" role="search" aria-label="Zoek in de drankenkaart">
      <label for="drinks-search">Waar heb je zin in?</label>
      <div class="drinks-search-field">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="1.5"/><path d="m15.5 15.5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        <input id="drinks-search" type="search" placeholder="Bijv. koffie, Duvel of alcoholvrij" autocomplete="off" spellcheck="false" maxlength="120" aria-controls="drinks-grid" aria-describedby="drinks-search-help">
        <button type="button" class="drinks-clear" hidden>Wissen</button>
      </div>
      <p id="drinks-search-help">Zoek op een drankje of categorie.</p>
    </div>
    <button type="button" class="drinks-expand" aria-controls="drinks-grid" aria-expanded="false">Alles openklappen</button>
  </div>
  <div class="drinks-filters" role="group" aria-label="Kies een drankcategorie" hidden>
    <button type="button" class="drinks-filter" data-drink-filter="alles" aria-pressed="true" aria-controls="drinks-grid">Alles</button>
    <button type="button" class="drinks-filter" data-drink-filter="koffie" aria-pressed="false" aria-controls="drinks-grid">Koffie &amp; thee</button>
    <button type="button" class="drinks-filter" data-drink-filter="bieren" aria-pressed="false" aria-controls="drinks-grid">Bieren</button>
    <button type="button" class="drinks-filter" data-drink-filter="apero" aria-pressed="false" aria-controls="drinks-grid">Apero</button>
    <button type="button" class="drinks-filter" data-drink-filter="alcoholvrij" aria-pressed="false" aria-controls="drinks-grid">0.0</button>
    <button type="button" class="drinks-share">Kopieer deze selectie <span aria-hidden="true">↗</span></button>
  </div>
  <p id="drinks-status" class="drinks-status" role="status" aria-live="polite" aria-atomic="true" hidden></p>
  <div class="drinks-share-fallback" hidden>
    <label for="drinks-share-url">Kopieer de link naar deze selectie:</label>
    <input id="drinks-share-url" type="url" readonly spellcheck="false">
  </div>
  <div class="drinks-grid" id="drinks-grid">
    <?php $drinkCategoryIndex = 0; ?>
    <?php foreach ($drinks as $category => $items): ?>
      <?php $drinkCategoryIndex++; ?>
      <details class="drink-card reveal">
        <summary class="drink-card-summary">
          <h3 class="drink-card-heading">
            <span class="drink-category-number" aria-hidden="true"><?= sprintf('%02d', $drinkCategoryIndex) ?></span>
            <span class="drink-category-title">
              <span class="drink-category-name"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></span>
              <span class="drink-category-count"><?= count($items) ?> keuzes</span>
            </span>
            <svg class="drink-toggle" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </h3>
        </summary>
        <ul class="drink-list">
          <?php foreach ($items as $item): ?>
            <li>
              <span class="drink-name"><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></span>
              <?php if (isset($drinkDescriptions[$item])): ?>
                <span class="drink-detail"><?= htmlspecialchars($drinkDescriptions[$item], ENT_QUOTES, 'UTF-8') ?></span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </details>
    <?php endforeach; ?>
  </div>

  <p class="drinks-empty" hidden>Geen passende drank gevonden. Probeer een andere zoekterm of wis je zoekopdracht.</p>

  <aside class="drinks-notes reveal" aria-label="Goed om te weten bij de drankenkaart">
    <p><strong>Mixers.</strong> Mix sterke drank met een frisdrank naar keuze.</p>
    <p>Vraag naar onze suggesties. We helpen je graag kiezen.</p>
    <p>1 rekening per tafel · Gelieve allergieën vooraf te melden.</p>
    <p>18+ voor sterke dranken · 16+ voor alcoholische dranken.</p>
  </aside>
</section>
