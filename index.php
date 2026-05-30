<?php
$pageTitle = 'De Pasto | De gezelligste huiskamer van Kapellen';
$nav = [
  'concept' => 'Concept',
  'menu' => 'Menu',
  'partners' => 'Partners',
  'uren' => 'Openingsuren',
  'social' => 'Sociaal',
  'contact' => 'Contact'
];
$menu = [
  'Koffie & warm' => ['Espresso', 'Koffie', 'Cappuccino', 'Latte macchiato', 'Chai latte', 'Verse munt- of gemberthee', 'Warme chocomelk'],
  'Fris & alcoholvrij' => ['Water plat/bruis', 'Cola & Cola Zero', 'Fuse Tea', 'Oxfam fruitsap', 'Homemade ice tea', 'Alcoholvrije bieren'],
  'Eten' => ['Croque classic / veggie', 'Pasta pomodoro', 'Pasta bolognaise', 'Soep van de week', 'Quiche met salade', 'Borrelplank'],
  'Avond & sharing' => ['Nacho’s met dips', 'Pizza slices', 'Croque uit het vuistje', 'Chips & nootjes', 'Dessert van de week']
];
$hours = [
  ['Maandag', '09:00–00:00'],
  ['Dinsdag', '09:00–00:00'],
  ['Woensdag', '09:00–00:00'],
  ['Donderdag', '09:00–00:00'],
  ['Vrijdag', '09:00–03:00'],
  ['Zaterdag', '10:00–03:00'],
  ['Zondag', '10:00–00:00'],
];
?>
<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="De Pasto is de gezelligste huiskamer van Kapellen: koffie, lunch, borrel en ontmoeting in het groene kader van de Oude Pastorij.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/menu-upgrades.css">
</head>
<body>
<header class="site-header" id="top">
  <a class="brand" href="#top" aria-label="De Pasto home">De Pasto</a>
  <button class="nav-toggle" type="button" aria-label="Menu openen" aria-expanded="false">☰</button>
  <nav class="site-nav" aria-label="Hoofdnavigatie">
    <?php foreach ($nav as $id => $label): ?>
      <a href="#<?= $id ?>"><?= htmlspecialchars($label) ?></a>
    <?php endforeach; ?>
  </nav>
</header>

<main>
  <section class="hero">
    <div class="hero-media" aria-hidden="true">
      <img src="assets/img/gallery/pasto-08.jpeg" alt="">
      <img src="assets/img/gallery/pasto-09.jpeg" alt="">
      <img src="assets/img/gallery/pasto-03.jpeg" alt="">
      <img src="assets/img/gallery/pasto-01.jpeg" alt="">
    </div>
    <div class="hero-card reveal">
      <p class="eyebrow">De gezelligste huiskamer van Kapellen</p>
      <h1>De Pasto</h1>
      <p>Een warme ontmoetingsplek in de groene tuin van het centrum. Voor koffie, lunch, pasta, borrel en een fijne avond met vrienden.</p>
      <div class="hero-actions">
        <a class="btn primary" href="#menu">Ontdek de kaart</a>
        <a class="btn secondary" href="#sfeer">Bekijk de sfeer</a>
      </div>
    </div>
  </section>

  <section class="section intro" id="concept">
    <div class="section-title reveal">
      <p class="eyebrow">Welkom</p>
      <h2>Warm in sfeer. Duidelijk in organisatie.</h2>
    </div>
    <div class="grid two">
      <article class="text-card reveal">
        <h3>Een plek voor iedereen</h3>
        <p>De Pasto brengt buren, gezinnen, wandelaars, fietsers en jongeren samen. Overdag laagdrempelig en rustig, ’s avonds levendig maar verzorgd.</p>
      </article>
      <article class="text-card reveal">
        <h3>Groen, lokaal en gezellig</h3>
        <p>We kiezen voor natuurlijke materialen, lokale accenten, eerlijke producten en een huiselijke stijl die past bij de Oude Pastorij.</p>
      </article>
    </div>
  </section>

  <section class="section sfeer" id="sfeer">
    <div class="section-title reveal">
      <p class="eyebrow">Sfeerbeelden</p>
      <h2>Groen, warm en vol karakter.</h2>
      <p>Van de rustige tuin tot de warme avondgloed binnen: De Pasto voelt als een plek waar je graag blijft hangen.</p>
    </div>

    <div class="photo-grid">
      <figure class="photo-item large reveal"><img src="assets/img/gallery/pasto-01.jpeg" alt="Groene tuin van De Pasto"></figure>
      <figure class="photo-item tall reveal"><img src="assets/img/gallery/pasto-02.jpeg" alt="Warme details in De Pasto"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-03.jpeg" alt="Avondbeeld van De Pasto"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-04.jpeg" alt="Gevel van De Oude Pastorij"></figure>
      <figure class="photo-item wide reveal"><img src="assets/img/gallery/pasto-05.jpeg" alt="Tuinpad richting De Pasto"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-06.jpeg" alt="Groene tegelwand detail"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-07.jpeg" alt="De Oude Pastorij tussen het groen"></figure>

    </div>
  </section>

  <section class="section menu" id="menu">
    <div class="section-title reveal">
      <p class="eyebrow">Drankenkaart</p>
<h2>Van koffie in de tuin tot een frisse pint aan de bar.</h2>
    </div>
    <div class="grid four">
      <?php foreach ($menu as $category => $items): ?>
        <article class="menu-card reveal">
          <h3><?= htmlspecialchars($category) ?></h3>
          <ul>
            <?php foreach ($items as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
          </ul>
        </article>
      <?php endforeach; ?>
    </div>
  </section>


  <!-- <section class="section partners" id="partners">
    <div class="section-title reveal">
      <p class="eyebrow">Onze partners</p>
      <h2>Sterke samenwerkingen, herkenbare kwaliteit.</h2>
      <p>Bij De Pasto kiezen we bewust voor partners die passen bij onze warme, lokale en toegankelijke sfeer. Dankzij Tout Bien, Duvel Moortgat, Seef en Coca-Cola bouwen we aan een drankenkaart met karakter: van frisse klassiekers tot Belgische bieren met verhaal.</p>
    </div>
    <div class="partner-grid">
      <article class="partner-card reveal">
        <div class="partner-logo"><img src="assets/img/partners/white_BG_No.svg" alt=""></div>
        <h3>Tout Bien</h3>
        <p>Een jonge Belgische bierpartner met een frisse uitstraling en veel goesting.</p>
      </article>
      <article class="partner-card reveal">
        <div class="partner-logo">Duvel<br>Moortgat</div>
        <h3>Duvel Moortgat</h3>
        <p>Een sterke brouwerijpartner voor kwaliteit, service en een rijk bieraanbod.</p>
      </article>
      <article class="partner-card reveal">
        <div class="partner-logo">Seef</div>
        <h3>Seef</h3>
        <p>Een Antwerps bier met geschiedenis, karakter en een duidelijke lokale link.</p>
      </article>
      <article class="partner-card reveal">
        <div class="partner-logo">Coca‑Cola</div>
        <h3>Coca-Cola</h3>
        <p>Herkenbare frisdranken, glazen en ondersteuning voor een verzorgde barwerking.</p>
      </article>
    </div>
    <p class="partner-note reveal">Logo’s kunnen later eenvoudig vervangen worden door officiële bestanden in <code>assets/img/partners/</code>.</p>
  </section> -->

  <section class="section hours" id="uren">
    <div class="hours-box reveal">
      <div>
        <p class="eyebrow">Openingsuren</p>
        <h2>Kom langs, strijk neer en voel je thuis.</h2>
        <p>Keuken tot 20:00. Late snacks tot 30 minuten voor sluiting. </br>
        Ook geopend op feestdagen, behalve 25/12 en 01/01.
      </p>
      </div>
      <div class="hours-list">
        <?php foreach ($hours as [$day, $time]): ?>
          <div><strong><?= htmlspecialchars($day) ?></strong><span><?= htmlspecialchars($time) ?></span></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section social" id="social">
    <div class="grid two align-center">
      <div class="section-title reveal">
        <p class="eyebrow">Buitengewoon VZW</p>
        <h2>Samen bouwen aan één herkenbare plek.</h2>
        <p>Op weekdagen werken we samen met het Buitengewoon VZW. Zo krijgt De Pasto een sterke dagwerking én een warme avondwerking met één gedeelde kwaliteitsstandaard.</p>
      </div>
      <div class="quote-card reveal">
        <p>“Een buitengewone gezellige plek, met respect voor personeel, buurt en omgeving.”</p>
      </div>
    </div>
  </section>

  <section class="section contact" id="contact">
    <div class="contact-card reveal">
      <div>
        <p class="eyebrow">Contact</p>
        <h2>Vraag, reservatie of samenwerking?</h2>
        <p>Stuur ons een bericht. Dit formulier gebruikt PHP en kan op je hosting gekoppeld worden aan jullie e-mailadres.</p>
      </div>
      <?php include __DIR__ . '/includes/contact-form.php'; ?>
    </div>
  </section>
</main>

<footer class="site-footer">
  <strong>De Pasto</strong>
  <span>Oude Pastorij · Dorpsstraat 45 · 2950 Kapellen</span>
  <a href="#top">Terug naar boven</a>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
