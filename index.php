<?php
$pageTitle = 'De Pasto | De gezelligste huiskamer van Kapellen';
require __DIR__ . '/includes/site-data.php';
$nav = [
  'concept' => 'De Pasto',
  'kaart' => 'De kaart',
  'sfeer' => 'Binnenkijken',
  'uren' => 'Je bezoek',
  'contact' => 'Contact'
];
// File timestamps refresh cached assets after a hosting upload.
$assetVersion = static function ($path) {
  return htmlspecialchars($path . '?v=' . filemtime(__DIR__ . '/' . $path), ENT_QUOTES, 'UTF-8');
};
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
    content="De Pasto is de gezelligste huiskamer van Kapellen. Geniet van koffie, apero, pasta, snacks en gezellige momenten in het groene kader van de Oude Pastorij."
  >

  <meta
    name="robots"
    content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"
  >

  <link rel="canonical" href="https://www.de-pasto.be/">

  <!-- Browserkleur -->
  <meta name="theme-color" content="#384510">

  <!-- Favicons -->
  <link rel="icon" href="assets/de-pasto-favicon/favicon.ico" sizes="any">
  <link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="assets/de-pasto-favicon/favicon-32x32.png"
  >
  <link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="assets/de-pasto-favicon/favicon-16x16.png"
  >
  <link
    rel="apple-touch-icon"
    sizes="180x180"
    href="assets/de-pasto-favicon/apple-touch-icon.png"
  >
  <link rel="manifest" href="assets/de-pasto-favicon/site.webmanifest">

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

  <!-- Lokale lettertypes: geen externe fontverzoeken. -->
  <link rel="preload" href="assets/fonts/playfair-display-normal-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="assets/fonts/montserrat-normal-latin.woff2" as="font" type="font/woff2" crossorigin>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/drinks-menu.css') ?>">
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/food-menu.css') ?>">
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/features.css') ?>">
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/hero.css') ?>">

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
        "url": "https://www.de-pasto.be/assets/de-pasto-favicon/favicon-512x512.png",
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
        "Pasta",
        "Snacks",
        "Café"
      ],
      "openingHoursSpecification": <?= json_encode($openingHoursSpecification, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>,
      "hasMenu": [
        {
          "@id": "https://www.de-pasto.be/#drankenkaart"
        },
        {
          "@id": "https://www.de-pasto.be/#eetkaart"
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
    },
    {
      "@type": "Menu",
      "@id": "https://www.de-pasto.be/#drankenkaart",
      "name": "Drankenkaart",
      "url": "https://www.de-pasto.be/#dranken",
      "description": "Koffie, warme dranken, frisdranken, Belgische bieren, aperitieven, wijnen en bubbels.",
      "inLanguage": "nl-BE"
    },
    {
      "@type": "Menu",
      "@id": "https://www.de-pasto.be/#eetkaart",
      "name": "Pasta & snacks",
      "url": "https://www.de-pasto.be/#eten",
      "description": "Pasta, croques, warme snacks en chips om samen van te genieten.",
      "inLanguage": "nl-BE"
    }
  ]
}
  </script>
</head>
<body id="top">
<a class="skip-link" href="#main">Ga naar de inhoud</a>
<header class="site-header">
  <a class="brand" href="#top" aria-label="De Pasto — naar boven">De Pasto<span>Oude Pastorij · Kapellen</span></a>
  <button class="nav-toggle" type="button" aria-label="Menu openen" aria-controls="site-navigation" aria-expanded="false" hidden><span class="nav-toggle-lines" aria-hidden="true"></span><span>Menu</span></button>
  <nav class="site-nav" id="site-navigation" aria-label="Hoofdnavigatie">
    <?php foreach ($nav as $id => $label): ?>
      <a href="#<?= $id ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></a>
    <?php endforeach; ?>
    <a class="nav-reservation" href="#contact" data-contact-intent="reservatie">Tafel aanvragen <span aria-hidden="true">↗</span></a>
  </nav>
</header>
<main id="main" tabindex="-1">
  <section class="hero hero-experience" id="hero-experience" aria-labelledby="hero-title">
    <div class="hero-scene-media" aria-hidden="true">
      <div class="hero-scene is-active" data-hero-scene="tuin" data-title="Koffie in het groen." data-description="Frisse lucht, een rustige koffie en even uit de drukte. Neem plaats in de tuin van de Oude Pastorij." data-link="#dranken" data-link-label="Kies je koffie" data-query="Warme dranken">
        <img src="assets/img/optimized/pasto-01-960.webp" srcset="assets/img/optimized/pasto-01-480.webp 480w, assets/img/optimized/pasto-01-960.webp 960w, assets/img/optimized/pasto-01-1366.webp 1366w" sizes="(max-width: 900px) 96vw, 70vw" width="1366" height="2048" fetchpriority="high" alt="">
      </div>
      <div class="hero-scene" data-hero-scene="bar" data-title="Op het goede gezelschap." data-description="Een frisse pint, een aperitief en een goed gesprek. Aan de bar is er altijd een reden om aan te schuiven." data-link="#dranken" data-link-label="Ontdek de apero" data-query="Aperitief">
        <img data-src="assets/img/optimized/pasto-15-960.webp" data-srcset="assets/img/optimized/pasto-15-480.webp 480w, assets/img/optimized/pasto-15-960.webp 960w, assets/img/optimized/pasto-15-1366.webp 1366w" sizes="(max-width: 900px) 96vw, 70vw" width="1366" height="2048" decoding="async" alt="">
      </div>
      <div class="hero-scene" data-hero-scene="avond" data-title="Nog eentje dan." data-description="De lichten gaan aan, de verhalen gaan verder. Voor die avonden waarop je gerust nog even blijft." data-link="#uren" data-link-label="Plan je avond">
        <img data-src="assets/img/optimized/pasto-03-960.webp" data-srcset="assets/img/optimized/pasto-03-480.webp 480w, assets/img/optimized/pasto-03-960.webp 960w, assets/img/optimized/pasto-03-1366.webp 1366w" sizes="(max-width: 900px) 96vw, 70vw" width="1366" height="2048" decoding="async" alt="">
      </div>
    </div>
    <div class="hero-experience-copy">
      <p class="eyebrow hero-experience-location"><span aria-hidden="true"></span> Oude Pastorij · Kapellen</p>
      <h1 id="hero-title">De Pasto</h1>
      <p class="hero-tagline">De gezelligste huiskamer van Kapellen.</p>
      <div class="hero-scene-story">
        <h2 data-hero-scene-title>Koffie in het groen.</h2>
        <p data-hero-scene-description>Frisse lucht, een rustige koffie en even uit de drukte. Neem plaats in de tuin van de Oude Pastorij.</p>
        <div class="hero-experience-actions"><a class="btn" href="#dranken" data-hero-scene-link><span class="hero-link-label" data-hero-link-label>Kies je koffie</span><span aria-hidden="true">↗</span></a><a class="text-link" href="#contact" data-contact-intent="reservatie">Schuif aan <span aria-hidden="true">↗</span></a></div>
      </div>
    </div>
    <div class="hero-moments" data-hero-controls hidden>
      <div class="hero-moments-heading"><span>Kies jouw moment</span><span class="hero-moments-hint">Drie keer De Pasto <span aria-hidden="true">↔</span></span></div>
      <div class="hero-choices" role="group" aria-label="Kies de sfeer van de hoofdbanner">
        <button type="button" class="hero-choice" data-hero-choice="tuin" aria-pressed="true" aria-controls="hero-experience"><img src="assets/img/optimized/pasto-01-480.webp" width="56" height="64" alt="" loading="lazy"><span class="hero-choice-copy"><span class="hero-choice-index" aria-hidden="true">01</span><span class="hero-choice-name">In de tuin</span><span class="hero-choice-detail">Koffie &amp; frisse lucht</span></span><span class="hero-choice-arrow" aria-hidden="true">↗</span></button>
        <button type="button" class="hero-choice" data-hero-choice="bar" aria-pressed="false" aria-controls="hero-experience"><img src="assets/img/optimized/pasto-15-480.webp" width="56" height="64" alt="" loading="lazy"><span class="hero-choice-copy"><span class="hero-choice-index" aria-hidden="true">02</span><span class="hero-choice-name">Aan de bar</span><span class="hero-choice-detail">Apero &amp; gezelschap</span></span><span class="hero-choice-arrow" aria-hidden="true">↗</span></button>
        <button type="button" class="hero-choice" data-hero-choice="avond" aria-pressed="false" aria-controls="hero-experience"><img src="assets/img/optimized/pasto-03-480.webp" width="56" height="64" alt="" loading="lazy"><span class="hero-choice-copy"><span class="hero-choice-index" aria-hidden="true">03</span><span class="hero-choice-name">Nog even blijven</span><span class="hero-choice-detail">Een avond bij ons</span></span><span class="hero-choice-arrow" aria-hidden="true">↗</span></button>
      </div>
    </div>
    <p class="visually-hidden" role="status" aria-live="polite" aria-atomic="true" data-hero-status></p>
  </section>
  <div class="welcome-strip">
    <a href="#uren"><span><span class="strip-label">Elke dag welkom</span>Kijk wanneer je kan aanschuiven</span><span aria-hidden="true">↗</span></a>
    <a href="#eten"><span><span class="strip-label">Kleine &amp; grote goesting</span>Pasta, croques &amp; iets om te delen</span><span aria-hidden="true">↗</span></a>
    <a href="https://www.google.com/maps/search/?api=1&amp;query=Dorpsstraat+45,+2950+Kapellen" target="_blank" rel="noopener noreferrer"><span><span class="strip-label">Midden in het groen</span>Dorpsstraat 45 · Kapellen</span><span aria-hidden="true">↗</span><span class="visually-hidden"> (opent in een nieuw tabblad)</span></a>
  </div>

  <section class="section intro" id="concept" aria-labelledby="concept-title">
    <div class="story-image reveal"><img src="assets/img/optimized/pasto-02-960.webp" srcset="assets/img/optimized/pasto-02-480.webp 480w, assets/img/optimized/pasto-02-960.webp 960w" sizes="(max-width: 760px) 90vw, 36vw" width="1366" height="2048" loading="lazy" decoding="async" alt="Warme verlichting en afgeronde nis in het interieur van De Pasto"><span class="image-caption">Historische charme. Warme details.</span></div>
    <div class="story-copy reveal">
      <p class="eyebrow">Aangenaam, wij zijn De Pasto</p>
      <h2 id="concept-title">Midden in het dorp.<br><em>Even uit de drukte.</em></h2>
      <p class="lead">Achter de gele gevel van de Oude Pastorij vind je een plek waar je gerust wat langer blijft.</p>
      <p>De Pasto brengt buren, gezinnen, wandelaars, fietsers en vrienden samen. Voor een rustige koffie overdag of een gezellige avond aan de bar. Je komt voor een drankje, je blijft voor het gevoel.</p>
      <p>Natuurlijke materialen, lokale accenten en een huiselijke sfeer: we houden van wat deze plek bijzonder maakt.</p>
      <a class="text-link" href="#sfeer">Kijk even binnen <span aria-hidden="true">↗</span></a>
    </div>
  </section>

  <section class="section moments" aria-labelledby="moments-title">
    <div class="section-title section-title-wide reveal"><div><p class="eyebrow">Op jouw tempo</p><h2 id="moments-title">Voor elk moment<br><em>een beetje Pasto.</em></h2></div><p>Van dat eerste kopje tot die laatste ronde. Vind jouw favoriete moment.</p></div>
    <div class="moments-grid">
      <a class="moment-card reveal" href="#dranken" data-drink-query="Warme dranken"><div class="moment-image"><img src="assets/img/optimized/pasto-01-960.webp" srcset="assets/img/optimized/pasto-01-480.webp 480w, assets/img/optimized/pasto-01-960.webp 960w" sizes="(max-width: 700px) 90vw, 30vw" width="1366" height="2048" loading="lazy" decoding="async" alt="De groene binnentuin met fontein"></div><div class="moment-copy"><span class="moment-label">Even op adem komen</span><h3>Koffie &amp; een babbel <span aria-hidden="true">↗</span></h3><p>Een vertrouwd kopje, een fijn gesprek en tijd voor jezelf.</p></div></a>
      <a class="moment-card reveal" href="#eten"><div class="moment-image"><img src="assets/img/optimized/pasto-15-960.webp" srcset="assets/img/optimized/pasto-15-480.webp 480w, assets/img/optimized/pasto-15-960.webp 960w" sizes="(max-width: 700px) 90vw, 30vw" width="1365" height="2048" loading="lazy" decoding="async" alt="De bar met glazen en biertaps bij De Pasto"></div><div class="moment-copy"><span class="moment-label">Met kleine of grote goesting</span><h3>Aan tafel <span aria-hidden="true">↗</span></h3><p>Pasta, een croque of iets lekkers om samen te delen.</p></div></a>
      <a class="moment-card reveal" href="#dranken" data-drink-query="Aperitief"><div class="moment-image"><img src="assets/img/optimized/pasto-17-960.webp" srcset="assets/img/optimized/pasto-17-480.webp 480w, assets/img/optimized/pasto-17-960.webp 960w" sizes="(max-width: 700px) 90vw, 30vw" width="1200" height="1600" loading="lazy" decoding="async" alt="Buitengewoon rosé in een wijnkoeler aan de bar"></div><div class="moment-copy"><span class="moment-label">Nog eentje dan</span><h3>Apero &amp; fijne avonden <span aria-hidden="true">↗</span></h3><p>Een frisse pint, een spritz en goed gezelschap.</p></div></a>
    </div>
  </section>

  <div id="kaart" class="menu-area" aria-label="Onze kaart">
    <?php include __DIR__ . '/includes/drinks-section.php'; ?>
    <?php include __DIR__ . '/includes/food-section.php'; ?>
  </div>

  <section class="section sfeer" id="sfeer" aria-labelledby="sfeer-title">
    <div class="section-title section-title-wide reveal"><div><p class="eyebrow">Even binnenkijken</p><h2 id="sfeer-title">Een huis<br><em>vol karakter.</em></h2></div><div class="gallery-intro"><p>Groen rondom, warmte vanbinnen. Een paar beelden zeggen soms meer dan wij kunnen vertellen.</p><p class="gallery-hint">Tik op een foto om rustig rond te kijken.</p></div></div>
    <div class="photo-grid">
      <?php
      $gallery = [
        ['08', 'De gele gevel van de Oude Pastorij tussen de bomen', 'large', 1366, 2048],
        ['02', 'Warme wandverlichting in een afgeronde nis', 'tall', 1366, 2048],
        ['17', 'Een fles Buitengewoon rosé aan de bar', '', 1200, 1600],
        ['15', 'Glazen en biertaps aan de bar van De Pasto', '', 1365, 2048],
        ['01', 'Groene tuin van De Pasto met fontein en zitbank', 'wide', 1366, 2048],
        ['04', 'Gele gevel en luiken van de Oude Pastorij', '', 1366, 2048],
        ['06', 'Detail van de groene tegelwand bij De Pasto', '', 1366, 2048],
        ['18', 'Medewerker van De Pasto achter de bar', '', 1200, 1600],
        ['05', 'Tuinpad en fontein voor de ingang van De Pasto', '', 1366, 2048],
        ['07', 'De Oude Pastorij omringd door bomen', '', 1366, 2048],
      ];
      foreach ($gallery as [$number, $alt, $class, $width, $height]): ?>
        <figure class="photo-item <?= $class ?> reveal"><a class="photo-link" href="assets/img/gallery/pasto-<?= $number ?>.jpeg" data-gallery aria-label="Vergroot foto: <?= htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') ?>"><img src="assets/img/optimized/pasto-<?= $number ?>-960.webp" srcset="assets/img/optimized/pasto-<?= $number ?>-480.webp 480w, assets/img/optimized/pasto-<?= $number ?>-960.webp 960w, assets/img/optimized/pasto-<?= $number ?>-1366.webp <?= $width ?>w" sizes="(max-width: 700px) 45vw, 30vw" width="<?= $width ?>" height="<?= $height ?>" loading="lazy" decoding="async" alt="<?= htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') ?>"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section social" id="social" aria-labelledby="social-title">
    <div class="social-copy reveal"><p class="eyebrow">De Pasto &amp; Buitengewoon VZW</p><h2 id="social-title">Samen is het<br><em>buitengewoon.</em></h2><p>Op weekdagen werken we samen met Buitengewoon VZW. Samen maken we van de Oude Pastorij een warme ontmoetingsplek, met aandacht voor onze gasten, medewerkers en de buurt.</p><p class="social-note">Buitengewoon VZW is open tijdens de week van 09:00 tot 16:00.</p></div>
    <blockquote class="quote-card reveal"><p>Een buitengewoon gezellige plek, met respect voor personeel, buurt en omgeving.</p><cite>De Pasto &amp; Buitengewoon VZW</cite></blockquote>
  </section>

  <section class="section hours" id="uren" aria-labelledby="hours-title">
    <div class="hours-box">
      <div class="hours-intro reveal"><p class="eyebrow">Maak er jouw moment van</p><h2 id="hours-title">De deur staat open.<br><em>Jij bent welkom.</em></h2><div class="hours-details"><p><strong>Keuken tot 20:00.</strong><br>Late snacks tot 30 minuten voor sluiting.</p><p>Ook geopend op feestdagen, behalve 25/12 en 01/01. Uitzonderlijke sluitingen worden aangekondigd op onze sociale media.</p></div><a class="btn secondary" href="https://www.google.com/maps/search/?api=1&amp;query=Dorpsstraat+45,+2950+Kapellen" target="_blank" rel="noopener noreferrer">Plan je route <span aria-hidden="true">↗</span><span class="visually-hidden"> (opent in een nieuw tabblad)</span></a></div>
      <div class="hours-panel reveal"><p class="hours-panel-title">Elke dag een goed moment.</p><dl class="hours-list"><?php foreach ($hours as $dayIndex => [$day, $time]): ?><div data-weekday="<?= $dayIndex + 1 ?>"><dt><?= htmlspecialchars($day, ENT_QUOTES, 'UTF-8') ?></dt><dd><?= htmlspecialchars($time, ENT_QUOTES, 'UTF-8') ?></dd></div><?php endforeach; ?></dl><p class="hours-note">Lokale uren in Kapellen · uitzonderingen hierboven</p><a class="hours-contact" href="#contact" data-contact-intent="reservatie">Vraag een tafel aan <span aria-hidden="true">↗</span></a></div>
    </div>
  </section>

  <section class="section practical" aria-labelledby="practical-title">
    <div class="section-title"><p class="eyebrow">Goed om te weten</p><h2 id="practical-title">Nog een <em>vraagje?</em></h2></div>
    <div class="faq-list">
      <details><summary>Hoe vraag ik een tafel aan?<span aria-hidden="true">+</span></summary><p>Kies ‘Een reservatie’ in het contactformulier en vul je gewenste datum, uur en aantal personen in. Of mail ons via info@de-pasto.be. Je reservatie is pas definitief na onze bevestiging.</p></details>
      <details><summary>Tot wanneer kan ik iets eten?<span aria-hidden="true">+</span></summary><p>Onze keuken is open tot 20:00. Late snacks zijn beschikbaar tot 30 minuten voor sluiting. Vraag gerust naar onze suggesties.</p></details>
      <details><summary>Wat als ik een allergie heb?<span aria-hidden="true">+</span></summary><p>Meld je allergieën vooraf aan ons team. We bekijken graag samen welke keuze geschikt is voor jou.</p></details>
      <details><summary>Een idee voor een samenwerking of samenkomst?<span aria-hidden="true">+</span></summary><p>Vertel ons wat je in gedachten hebt via het contactformulier. We denken graag mee en bespreken samen wat mogelijk is.</p></details>
    </div>
  </section>

  <section class="section contact" id="contact" aria-labelledby="contact-title">
    <div class="contact-card">
      <div class="contact-intro reveal"><p class="eyebrow">We horen graag van je</p><h2 id="contact-title">Zeg eens <em>hallo.</em></h2><p>Een tafel aanvragen, een vraag stellen of samen iets moois opzetten? Laat van je horen. We denken graag met je mee.</p><address class="contact-details"><div><span class="detail-label">Schrijf ons</span><a class="contact-email" href="mailto:info@de-pasto.be">info@de-pasto.be <span aria-hidden="true">↗</span></a></div><div><span class="detail-label">Je vindt ons hier</span><strong>De Oude Pastorij</strong><br>Dorpsstraat 45<br>2950 Kapellen</div></address><p class="reservation-note">Een reservatie is pas definitief na onze bevestiging.</p></div>
      <div class="contact-form-panel"><h3>Tot binnenkort?</h3><?php include __DIR__ . '/includes/contact-form.php'; ?></div>
    </div>
  </section>
</main>
<footer class="site-footer">
  <div class="footer-invitation"><p>Schuif aan.<br><em>Blijf nog even.</em></p><a class="btn secondary" href="#contact" data-contact-intent="reservatie">Tafel aanvragen <span aria-hidden="true">↗</span></a></div>
  <div class="footer-main"><div><a class="footer-brand" href="#top">De Pasto</a><p>De gezelligste huiskamer van Kapellen</p></div><address>Oude Pastorij<br>Dorpsstraat 45 · 2950 Kapellen<br><a href="mailto:info@de-pasto.be">info@de-pasto.be</a></address><a class="back-to-top" href="#top">Terug naar boven <span aria-hidden="true">↑</span></a></div>
  <div class="footer-bottom"><span>© <?= date('Y') ?> De Pasto · Team Pasto</span><span>BTW BE1036.699.079</span><span>Met goesting, in Kapellen.</span></div>
</footer>
<nav class="mobile-cta" aria-label="Snel naar"><a href="#kaart">De kaart</a><a href="#uren">Je bezoek</a><a href="#contact" data-contact-intent="reservatie">Tafel aanvragen <span aria-hidden="true">↗</span></a></nav>
<dialog class="gallery-dialog" aria-labelledby="gallery-dialog-title"><div class="gallery-dialog-top"><h2 id="gallery-dialog-title">Even binnenkijken</h2><button class="gallery-close" type="button" autofocus>Sluiten <span aria-hidden="true">×</span></button></div><figure class="gallery-dialog-figure"><img class="gallery-dialog-image" alt="" decoding="async"><figcaption class="gallery-dialog-caption"></figcaption></figure><div class="gallery-thumbnails" role="group" aria-label="Kies een sfeerfoto" hidden></div><p class="gallery-gesture-hint" hidden>Veeg om te bladeren.</p><div class="gallery-dialog-bottom"><button class="gallery-previous" type="button" aria-label="Vorige foto">← Vorige</button><p class="gallery-status" role="status" aria-live="polite"></p><button class="gallery-next" type="button" aria-label="Volgende foto">Volgende →</button></div></dialog>
<script src="<?= $assetVersion('assets/js/main.js') ?>" defer></script>
<script src="<?= $assetVersion('assets/js/hero.js') ?>" defer></script>
<script src="<?= $assetVersion('assets/js/experience.js') ?>" defer></script>
<script src="<?= $assetVersion('assets/js/gallery.js') ?>" defer></script>
<script src="<?= $assetVersion('assets/js/contact.js') ?>" defer></script>
</body>
</html>
