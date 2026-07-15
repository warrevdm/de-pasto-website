<?php
$drinks = [
  'Frisdranken' => [
    ['Plat / Bruis 25cl', '2,80'],
    ['Plat / Bruis 50cl', '5,00'],
    ['Cola / Cola Zero', '2,80'],
    ['Fanta', '2,80'],
    ['Fuze Tea Sparkling', '2,80'],
    ['Fuze Tea Green', '2,80'],
    ['Fever-Tree Ginger Ale', '4,40'],
    ['Fever-Tree Mediterranean', '4,40'],
    ['Red Bull', '5,00'],
    ['Almdudler', '4,50'],
    ['Schweppes Agrum Zero', '3,80'],
    ['Bionade Ginger', '4,80'],
    ['Bionade Lemon', '4,80'],
    ['Fairtrade Appelsap', '3,30'],
    ['Fairtrade Sinaasappelsap', '3,30'],
    ['Fairtrade Pompelmoessap', '3,50'],
    ['Cécémel', '3,20'],
    ['Fristi', '3,20'],
  ],
  'Warme dranken' => [
    ['Espresso', '3,00'],
    ['Dubbele Espresso', '4,00'],
    ['Koffie', '3,00'],
    ['Koffie Lungo', '3,50'],
    ['Koffie verkeerd', '4,00'],
    ['Latte Macchiato', '4,00'],
    ['Cappuccino melk', '4,00'],
    ['Deca Koffie', '3,00'],
    ['Warme Choco', '4,00'],
    ['Thee', '3,00'],
    ['Verse Munt Thee', '4,00'],
    ['Verse Gember Thee', '4,00'],
    ['Chai Latte', '4,00'],
    ['Matcha Latte', '4,00'],
    ['Supplement slagroom / siroop', '1,50'],
  ],
  'Bieren van ’t vat' => [
    ['Tout Bien 25cl', '2,90'],
    ['Tout Bien 33cl', '3,30'],
    ['Tout Bien 50cl', '4,90'],
    ['Tripel d’Anvers 33cl', '5,00'],
    ['Bolleke De Koninck', '3,60'],
    ['Liefmans On The Rocks', '4,00'],
    ['Wisseltap', ''],
  ],
  'Bieren op fles' => [
    ['Duvel', '4,50'],
    ['Duvel 666', '4,50'],
    ['La Chouffe', '4,50'],
    ['Vedett Extra Blond', '3,80'],
    ['Westmalle Dubbel', '4,20'],
    ['Westmalle Tripel', '4,80'],
    ['Salitos Blue', '4,90'],
    ['Salitos Ice', '4,90'],
    ['Salitos Pink', '4,90'],
  ],
  'Alcoholvrije bieren' => [
    ['Vedett Extra Blond 0.0%', '3,40'],
    ['Liefmans On The Rocks 0.0%', '3,80'],
    ['La Chouffe 0.0%', '3,80'],
  ],
  'Sterke dranken' => [
    ['Trojka Vodka', '6,00'],
    ['Absolut Vodka', '8,00'],
    ['Kraken Black Spiced Rum', '8,00'],
    ['Bacardi Spiced Rum', '6,00'],
    ['Bacardi White Rum', '6,00'],
    ['Passoa', '6,00'],
    ['Pisang', '6,00'],
    ['Licor 43', '6,00'],
    ['J.W. Red Label Whiskey', '8,00'],
    ['Amaretto Di Saronno', '8,00'],
  ],
  'Aperitief' => [
    ['Aperol Spritz', '9,00'],
    ['Mimosa', '9,00'],
    ['Limoncello Spritz', '9,00'],
    ['Porto', '5,50'],
    ['Martini Bianco', '6,00'],
    ['Martini Rosso', '6,00'],
    ['Limoncello', '6,00'],
    ['Gin & Tonic Copperhead', '14,00'],
    ['Gin & Tonic Copperhead 0.0', '12,00'],
    ['Gin & Tonic Mare', '10,00'],
  ],
  'Wijn & bubbels' => [
    ['Buitengewoon Wit', '4,50'],
    ['Buitengewoon Rosé', '4,50'],
    ['Buitengewoon Rood', '4,50'],
    ['Vache D’Automne Wit', '4,80'],
    ['Vache D’Automne Rosé', '4,80'],
    ['Vache D’Automne Rood', '4,80'],
    ['Chat. Les Fontelles Zoet', '5,00'],
    ['Barrio Cava', '6,50'],
    ['Fles Buitengewoon', '25,00'],
    ['Fles Vache D’Automne', '27,00'],
    ['Fles Chat. Les Fontelles Zoet', '28,00'],
    ['Fles Cava', '32,00'],
  ],
];
?>
<section class="section drinks-section" id="dranken">
  <div class="section-title reveal">
    <p class="eyebrow">Drankenkaart</p>
    <h2>Van koffie in de tuin tot een frisse pint aan de bar.</h2>
    <p>Ontdek onze selectie warme dranken, frisdranken, Belgische bieren, aperitieven, wijnen en bubbels.</p>
  </div>

  <div class="drinks-grid">
    <?php foreach ($drinks as $category => $items): ?>
      <article class="drink-card reveal">
        <h3><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></h3>
        <ul class="drink-list">
          <?php foreach ($items as $item): ?>
            <li>
              <span><?= htmlspecialchars($item[0], ENT_QUOTES, 'UTF-8') ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="drinks-notes reveal">
    <p><strong>Mixers:</strong> mix sterke drank met een frisdrank naar keuze.</p>
    <p>1 rekening per tafel · Gelieve allergieën vooraf te melden.</p>
    <p>18+ voor sterke dranken · 16+ voor alcoholische dranken.</p>
  </div>
</section>
