<?php
$pageTitle = 'De Pasto | De gezelligste huiskamer van Kapellen';
$nav = [
  'concept' => 'Concept',
  'dranken' => 'Dranken',
  'uren' => 'Openingsuren',
  'social' => 'Sociaal',
  'contact' => 'Contact'
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

  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

  <!-- Basis SEO -->
  <meta
    name="description"
    content="De Pasto is de gezelligste huiskamer van Kapellen. Geniet van koffie, apero en gezellige momenten in het groene kader van de Oude Pastorij."
  >

  <meta
    name="robots"
    content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"
  >

  <link rel="canonical" href="https://www.de-pasto.be/">

  <!-- Browserkleur -->
  <meta name="theme-color" content="#384510">

  <!-- Favicons -->
  <link rel="icon" href="/favicon.ico" sizes="any">
  <link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="/favicon-32x32.png"
  >
  <link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="/favicon-16x16.png"
  >
  <link
    rel="apple-touch-icon"
    sizes="180x180"
    href="/apple-touch-icon.png"
  >
  <link rel="manifest" href="/site.webmanifest">

  <!-- Open Graph: Facebook, LinkedIn, WhatsApp -->
  <meta
    property="og:title"
    content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>"
  >
  <meta
    property="og:description"
    content="Een warme ontmoetingsplek in de Oude Pastorij van Kapellen. Ontdek De Pasto, de gezelligste huiskamer van Kapellen."
  >
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.de-pasto.be/">
  <meta property="og:site_name" content="De Pasto">
  <meta property="og:locale" content="nl_BE">

  <meta
    property="og:image"
    content="https://www.de-pasto.be/assets/img/gallery/pasto-09.jpeg"
  >
  <meta
    property="og:image:alt"
    content="De Pasto in de groene tuin van de Oude Pastorij in Kapellen"
  >
  <meta property="og:image:type" content="image/jpeg">

  <!-- X / Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta
    name="twitter:title"
    content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>"
  >
  <meta
    name="twitter:description"
    content="De gezelligste huiskamer van Kapellen, gelegen in de groene tuin van de Oude Pastorij."
  >
  <meta
    name="twitter:image"
    content="https://www.de-pasto.be/assets/img/gallery/pasto-09.jpeg"
  >
  <meta
    name="twitter:image:alt"
    content="De Pasto in de Oude Pastorij van Kapellen"
  >

  <!-- Lettertypes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
  >
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700;800;900&display=swap"
    rel="stylesheet"
  >

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/menu-upgrades.css">
  <link rel="stylesheet" href="assets/css/drinks-menu.css">

  <!-- Schema.org structured data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "CafeOrCoffeeShop",
        "@id": "https://www.de-pasto.be/#cafe",
        "name": "De Pasto",
        "alternateName": "De Pasto Kapellen",
        "description": "De Pasto is de gezelligste huiskamer van Kapellen. Een warme ontmoetingsplek in de groene tuin van de Oude Pastorij.",
        "url": "https://www.de-pasto.be/",
        "email": "info@de-pasto.be",
        "logo": {
          "@type": "ImageObject",
          "url": "https://www.de-pasto.be/favicon-512x512.png",
          "width": 512,
          "height": 512
        },
        "image": [
          "https://www.de-pasto.be/assets/img/gallery/pasto-01.jpeg",
          "https://www.de-pasto.be/assets/img/gallery/pasto-03.jpeg",
          "https://www.de-pasto.be/assets/img/gallery/pasto-09.jpeg"
        ],
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Dorpsstraat 45",
          "postalCode": "2950",
          "addressLocality": "Kapellen",
          "addressRegion": "Antwerpen",
          "addressCountry": "BE"
        },
        "servesCuisine": [
          "Belgisch",
          "Koffie",
          "Aperitief",
          "Café"
        ],
        "openingHoursSpecification": [
          {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
              "Monday",
              "Tuesday",
              "Wednesday",
              "Thursday"
            ],
            "opens": "10:00",
            "closes": "00:00"
          },
          {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
              "Friday",
              "Saturday"
            ],
            "opens": "10:00",
            "closes": "03:00"
          },
          {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Sunday",
            "opens": "10:00",
            "closes": "00:00"
          }
        ]
      },
      {
        "@type": "WebSite",
        "@id": "https://www.de-pasto.be/#website",
        "url": "https://www.de-pasto.be/",
        "name": "De Pasto",
        "description": "De gezelligste huiskamer van Kapellen.",
        "inLanguage": "nl-BE",
        "publisher": {
          "@id": "https://www.de-pasto.be/#cafe"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://www.de-pasto.be/#webpage",
        "url": "https://www.de-pasto.be/",
        "name": "De Pasto | De gezelligste huiskamer van Kapellen",
        "description": "Ontdek De Pasto, een warme ontmoetingsplek in de groene tuin van de Oude Pastorij in Kapellen.",
        "isPartOf": {
          "@id": "https://www.de-pasto.be/#website"
        },
        "about": {
          "@id": "https://www.de-pasto.be/#cafe"
        },
        "primaryImageOfPage": {
          "@type": "ImageObject",
          "url": "https://www.de-pasto.be/assets/img/gallery/pasto-09.jpeg"
        },
        "inLanguage": "nl-BE"
      }
    ]
  }
  </script>
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
      <img src="assets/img/gallery/pasto-13.jpeg" alt="">
      <img src="assets/img/gallery/pasto-08.jpeg" alt="">
      <img src="assets/img/gallery/pasto-18.jpeg" alt="">
      <img src="assets/img/gallery/pasto-01.jpeg" alt="">
      <img src="assets/img/gallery/pasto-18.jpeg" alt="">
    </div>
    <div class="hero-card reveal">
      <p class="eyebrow">De gezelligste huiskamer van Kapellen</p>
      <h1>De Pasto</h1>
      <p>Een warme ontmoetingsplek in de groene tuin van het centrum. Voor koffie, lunch, pasta, borrel en een fijne avond met vrienden.</p>
      <div class="hero-actions">
        <a class="btn primary" href="#dranken">Bekijk de drankenkaart</a>
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
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-18.jpeg" alt="Avondbeeld van De Pasto"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-04.jpeg" alt="Gevel van De Oude Pastorij"></figure>
      <figure class="photo-item wide reveal"><img src="assets/img/gallery/pasto-05.jpeg" alt="Tuinpad richting De Pasto"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-06.jpeg" alt="Groene tegelwand detail"></figure>
      <figure class="photo-item reveal"><img src="assets/img/gallery/pasto-07.jpeg" alt="De Oude Pastorij tussen het groen"></figure>
    </div>
  </section>

  <?php include __DIR__ . '/includes/drinks-section.php'; ?>

  <section class="section hours" id="uren">
    <div class="hours-box reveal">
      <div>
        <p class="eyebrow">Openingsuren</p>
        <h2>Kom langs, strijk neer en voel je thuis.</h2>
        <p>Keuken tot 20:00. Late snacks tot 30 minuten voor sluiting. <br>
        Ook geopend op feestdagen, behalve 25/12 en 01/01. <br>
        Uitzonderlijke sluitingen worden aangekondigd op onze sociale media.<br>
        Buitengewoon VZW is open tijdens de week van 09:00 tot 16:00.
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
      </div>
      <?php include __DIR__ . '/includes/contact-form.php'; ?>
    </div>
  </section>
</main>

<footer class="site-footer">
  <strong>De Pasto</strong>
  <span>Team Pasto · Oude Pastorij · Dorpstraat 45 · 2950 Kapellen · BE1036.699.079</span>
  <a href="#top">Terug naar boven</a>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
