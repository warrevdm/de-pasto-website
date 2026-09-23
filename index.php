<?php
$pageTitle = 'De Pasto | De gezelligste huiskamer van Kapellen';
$nav = [
  'concept' => 'Concept',
  'sfeer' => 'Sfeer',
  'dranken' => 'Dranken',
  'eten' => 'Pasta & snacks',
  'uren' => 'Openingsuren',
  'social' => 'Sociaal',
  'contact' => 'Contact'
];
// File timestamps refresh cached assets after a hosting upload.
$assetVersion = static function ($path) {
  return htmlspecialchars($path . '?v=' . filemtime(__DIR__ . '/' . $path), ENT_QUOTES, 'UTF-8');
};
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
  <link rel="stylesheet" href="<?= $assetVersion('assets/css/design-refinements.css') ?>">

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
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday"
          ],
          "opens": "09:00",
          "closes": "00:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Friday",
          "opens": "09:00",
          "closes": "03:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "10:00",
          "closes": "03:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Sunday",
          "opens": "10:00",
          "closes": "00:00"
        }
      ],
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
  <button class="nav-toggle" type="button" aria-label="Menu openen" aria-controls="site-navigation" aria-expanded="false" hidden>
    <span class="nav-toggle-lines" aria-hidden="true"></span><span>Menu</span>
  </button>
  <nav class="site-nav" id="site-navigation" aria-label="Hoofdnavigatie">
    <?php foreach ($nav as $id => $label): ?>
      <a href="#<?= $id ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></a>
    <?php endforeach; ?>
  </nav>
</header>

<main id="main" tabindex="-1">
  <section class="hero" aria-labelledby="hero-title">
    <div class="hero-card">
      <p class="eyebrow">Een groene plek. Midden in Kapellen.</p>
      <h1 id="hero-title">De Pasto<span>De gezelligste huiskamer<br><em>van Kapellen</em></span></h1>
      <p class="hero-description">Een warme ontmoetingsplek in de groene tuin van het centrum. Voor koffie, lunch, pasta, borrel en een fijne avond met vrienden.</p>
      <div class="hero-actions">
        <a class="btn primary" href="#dranken">Bekijk de drankenkaart <span aria-hidden="true">↗</span></a>
        <a class="btn secondary" href="#eten">Bekijk pasta &amp; snacks <span aria-hidden="true">↗</span></a>
      </div>
      <a class="text-link hero-contact" href="#contact">Contact, reservatie of samenwerking <span aria-hidden="true">↗</span></a>
      <div class="hero-footnote"><span aria-hidden="true">—</span> Schuif aan. Blijf gerust wat langer.</div>
    </div>
    <div class="hero-visual">
      <div class="hero-media" aria-hidden="true">
        <img class="is-active" src="assets/img/optimized/pasto-08-960.webp" srcset="assets/img/optimized/pasto-08-480.webp 480w, assets/img/optimized/pasto-08-960.webp 960w, assets/img/optimized/pasto-08-1366.webp 1366w" sizes="(max-width: 900px) 100vw, 50vw" width="1366" height="2048" fetchpriority="high" data-caption="De Oude Pastorij in het groen" alt="">
        <img data-src="assets/img/optimized/pasto-13-960.webp" data-srcset="assets/img/optimized/pasto-13-480.webp 480w, assets/img/optimized/pasto-13-960.webp 960w, assets/img/optimized/pasto-13-1366.webp 1365w" sizes="(max-width: 900px) 100vw, 50vw" width="1365" height="2048" decoding="async" data-caption="Apero in de tuin" alt="">
        <img data-src="assets/img/optimized/pasto-18-960.webp" data-srcset="assets/img/optimized/pasto-18-480.webp 480w, assets/img/optimized/pasto-18-960.webp 960w, assets/img/optimized/pasto-18-1366.webp 1200w" sizes="(max-width: 900px) 100vw, 50vw" width="1200" height="1600" decoding="async" data-caption="Een fijne avond aan de bar" alt="">
        <img data-src="assets/img/optimized/pasto-01-960.webp" data-srcset="assets/img/optimized/pasto-01-480.webp 480w, assets/img/optimized/pasto-01-960.webp 960w, assets/img/optimized/pasto-01-1366.webp 1366w" sizes="(max-width: 900px) 100vw, 50vw" width="1366" height="2048" decoding="async" data-caption="Even ontsnappen in de tuin" alt="">
      </div>
      <div class="hero-stamp" aria-hidden="true"><span>De Oude Pastorij</span><div>Kom binnen.<br><em>Voel je thuis.</em></div></div>
      <div class="hero-controls" hidden>
        <div class="slide-info"><span class="slide-counter" aria-hidden="true">01 / 04</span><span class="slide-caption">De Oude Pastorij in het groen</span></div>
        <button class="slider-prev" type="button" aria-label="Vorige sfeerfoto"><span aria-hidden="true">←</span></button>
        <button class="slider-next" type="button" aria-label="Volgende sfeerfoto"><span aria-hidden="true">→</span></button>
        <button class="slider-toggle" type="button" aria-pressed="false" aria-label="Fotoslider pauzeren"><span aria-hidden="true">Ⅱ</span></button>
      </div>
    </div>
  </section>

  <div class="welcome-strip">
    <p><span class="strip-label">Van vroeg tot laat</span>Koffie, apero &amp; fijne avonden</p>
    <a href="#uren"><span><span class="strip-label">Plan je bezoek</span>Elke dag welkom</span><span aria-hidden="true">↗</span></a>
    <a href="#contact"><span><span class="strip-label">Midden in Kapellen</span>Oude Pastorij · Dorpsstraat 45</span><span aria-hidden="true">↗</span></a>
  </div>

  <section class="section intro" id="concept" aria-labelledby="concept-title">
    <div class="section-title reveal">
      <p class="eyebrow">01 / Welkom bij De Pasto</p>
      <h2 id="concept-title">Warm in sfeer.<br><em>Duidelijk in organisatie.</em></h2>
    </div>
    <div class="grid two">
      <article class="text-card reveal">
        <span class="card-mark" aria-hidden="true">01</span>
        <h3>Een plek voor iedereen</h3>
        <p>De Pasto brengt buren, gezinnen, wandelaars, fietsers en jongeren samen. Overdag laagdrempelig en rustig, ’s avonds levendig maar verzorgd.</p>
      </article>
      <article class="text-card reveal">
        <span class="card-mark" aria-hidden="true">02</span>
        <h3>Groen, lokaal en gezellig</h3>
        <p>We kiezen voor natuurlijke materialen, lokale accenten, eerlijke producten en een huiselijke stijl die past bij de Oude Pastorij.</p>
      </article>
    </div>
  </section>

  <section class="section sfeer" id="sfeer" aria-labelledby="sfeer-title">
    <div class="section-title section-title-wide reveal">
      <div><p class="eyebrow">02 / Even binnenkijken</p><h2 id="sfeer-title">Groen, warm<br><em>en vol karakter.</em></h2></div>
      <div class="gallery-intro"><p>Van de rustige tuin tot de warme avondgloed binnen: De Pasto voelt als een plek waar je graag blijft hangen.</p><p class="gallery-hint">Klik op een foto en kijk rustig rond.</p></div>
    </div>
    <div class="photo-grid">
      <figure class="photo-item large reveal"><a class="photo-link" href="assets/img/gallery/pasto-01.jpeg" data-gallery aria-label="Vergroot foto: Groene tuin van De Pasto met fontein en zitbank"><img src="assets/img/optimized/pasto-01-960.webp" srcset="assets/img/optimized/pasto-01-480.webp 480w, assets/img/optimized/pasto-01-960.webp 960w, assets/img/optimized/pasto-01-1366.webp 1366w" sizes="(max-width: 440px) calc(100vw - 44px), (max-width: 900px) 90vw, (max-width: 1660px) 37vw, 600px" width="1366" height="2048" loading="lazy" decoding="async" alt="Groene tuin van De Pasto met fontein en zitbank"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a><figcaption>Een beetje groen. Een heleboel gezelligheid.</figcaption></figure>
      <figure class="photo-item tall reveal"><a class="photo-link" href="assets/img/gallery/pasto-02.jpeg" data-gallery aria-label="Vergroot foto: Warme wandverlichting in een nis bij De Pasto"><img src="assets/img/optimized/pasto-02-960.webp" srcset="assets/img/optimized/pasto-02-480.webp 480w, assets/img/optimized/pasto-02-960.webp 960w, assets/img/optimized/pasto-02-1366.webp 1366w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 24vw, 390px" width="1366" height="2048" loading="lazy" decoding="async" alt="Warme wandverlichting in een nis bij De Pasto"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <figure class="photo-item  reveal"><a class="photo-link" href="assets/img/gallery/pasto-18.jpeg" data-gallery aria-label="Vergroot foto: Medewerker van De Pasto achter de bar"><img src="assets/img/optimized/pasto-18-960.webp" srcset="assets/img/optimized/pasto-18-480.webp 480w, assets/img/optimized/pasto-18-960.webp 960w, assets/img/optimized/pasto-18-1366.webp 1200w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 30vw, 480px" width="1200" height="1600" loading="lazy" decoding="async" alt="Medewerker van De Pasto achter de bar"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <figure class="photo-item  reveal"><a class="photo-link" href="assets/img/gallery/pasto-04.jpeg" data-gallery aria-label="Vergroot foto: Gele gevel en luiken van de Oude Pastorij"><img src="assets/img/optimized/pasto-04-960.webp" srcset="assets/img/optimized/pasto-04-480.webp 480w, assets/img/optimized/pasto-04-960.webp 960w, assets/img/optimized/pasto-04-1366.webp 1366w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 30vw, 480px" width="1366" height="2048" loading="lazy" decoding="async" alt="Gele gevel en luiken van de Oude Pastorij"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <figure class="photo-item wide reveal"><a class="photo-link" href="assets/img/gallery/pasto-05.jpeg" data-gallery aria-label="Vergroot foto: Tuinpad en fontein voor de ingang van De Pasto"><img src="assets/img/optimized/pasto-05-960.webp" srcset="assets/img/optimized/pasto-05-480.webp 480w, assets/img/optimized/pasto-05-960.webp 960w, assets/img/optimized/pasto-05-1366.webp 1366w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 37vw, 600px" width="1366" height="2048" loading="lazy" decoding="async" alt="Tuinpad en fontein voor de ingang van De Pasto"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <figure class="photo-item  reveal"><a class="photo-link" href="assets/img/gallery/pasto-06.jpeg" data-gallery aria-label="Vergroot foto: Detail van de groene tegelwand bij De Pasto"><img src="assets/img/optimized/pasto-06-960.webp" srcset="assets/img/optimized/pasto-06-480.webp 480w, assets/img/optimized/pasto-06-960.webp 960w, assets/img/optimized/pasto-06-1366.webp 1366w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 24vw, 390px" width="1366" height="2048" loading="lazy" decoding="async" alt="Detail van de groene tegelwand bij De Pasto"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
      <figure class="photo-item  reveal"><a class="photo-link" href="assets/img/gallery/pasto-07.jpeg" data-gallery aria-label="Vergroot foto: De Oude Pastorij omringd door bomen"><img src="assets/img/optimized/pasto-07-960.webp" srcset="assets/img/optimized/pasto-07-480.webp 480w, assets/img/optimized/pasto-07-960.webp 960w, assets/img/optimized/pasto-07-1366.webp 1366w" sizes="(max-width: 440px) calc(50vw - 28px), (max-width: 900px) 44vw, (max-width: 1660px) 30vw, 480px" width="1366" height="2048" loading="lazy" decoding="async" alt="De Oude Pastorij omringd door bomen"><span class="photo-view" aria-hidden="true">Bekijk foto ↗</span></a></figure>
    </div>
  </section>

  <?php include __DIR__ . '/includes/drinks-section.php'; ?>
  <?php include __DIR__ . '/includes/food-section.php'; ?>

  <section class="section hours" id="uren" aria-labelledby="hours-title">
    <div class="hours-box">
      <div class="hours-intro reveal">
        <p class="eyebrow">05 / Openingsuren</p>
        <h2 id="hours-title">Kom langs,<br>strijk neer en<br><em>voel je thuis.</em></h2>
        <div class="hours-details">
          <p><strong>Keuken tot 20:00.</strong><br>Late snacks tot 30 minuten voor sluiting.</p>
          <p>Ook geopend op feestdagen, behalve 25/12 en 01/01. Uitzonderlijke sluitingen worden aangekondigd op onze sociale media.</p>
          <p>Buitengewoon VZW is open tijdens de week van 09:00 tot 16:00.</p>
        </div>
      </div>
      <div class="hours-panel reveal">
        <p class="hours-panel-title">Elke dag een goed moment.</p>
        <dl class="hours-list">
          <?php foreach ($hours as $dayIndex => [$day, $time]): ?>
            <div data-weekday="<?= $dayIndex + 1 ?>"><dt><?= htmlspecialchars($day, ENT_QUOTES, 'UTF-8') ?></dt><dd><?= htmlspecialchars($time, ENT_QUOTES, 'UTF-8') ?></dd></div>
          <?php endforeach; ?>
        </dl>
        <p class="hours-note">Alle uren zijn lokale uren in Kapellen.</p>
        <a class="hours-contact" href="#contact">Liever vooraf een tafel aanvragen? <span aria-hidden="true">↗</span></a>
      </div>
    </div>
  </section>

  <section class="section social" id="social" aria-labelledby="social-title">
    <div class="grid two align-center">
      <div class="section-title reveal">
        <p class="eyebrow">06 / Buitengewoon VZW</p>
        <h2 id="social-title">Samen bouwen aan <em>één herkenbare plek.</em></h2>
        <p>Op weekdagen werken we samen met het Buitengewoon VZW. Zo krijgt De Pasto een sterke dagwerking én een warme avondwerking met één gedeelde kwaliteitsstandaard.</p>
      </div>
      <blockquote class="quote-card reveal">
        <span class="quote-mark" aria-hidden="true">“</span>
        <p>Een buitengewone gezellige plek, met respect voor personeel, buurt en omgeving.</p>
        <cite>De Pasto &amp; Buitengewoon VZW</cite>
      </blockquote>
    </div>
  </section>

  <section class="section contact" id="contact" aria-labelledby="contact-title">
    <div class="contact-card">
      <div class="contact-intro reveal">
        <p class="eyebrow">07 / We horen graag van je</p>
        <h2 id="contact-title">Vraag, reservatie<br>of <em>samenwerking?</em></h2>
        <p>Een tafel aanvragen, iets organiseren of samen iets moois opzetten? Stuur ons een bericht of mail rechtstreeks. We denken graag met je mee.</p>
        <address class="contact-details">
          <div><span class="detail-label">Mail ons</span><a class="contact-email" href="mailto:info@de-pasto.be">info@de-pasto.be <span aria-hidden="true">↗</span></a></div>
          <div><span class="detail-label">Kom langs</span><strong>De Oude Pastorij</strong><br>Dorpsstraat 45<br>2950 Kapellen<br><a class="route-link" href="https://www.google.com/maps/search/?api=1&amp;query=Dorpsstraat+45,+2950+Kapellen" target="_blank" rel="noopener noreferrer">Plan je route <span aria-hidden="true">↗</span><span class="visually-hidden"> (opent in een nieuw tabblad)</span></a></div>
        </address>
        <p class="reservation-note">Een reservatie is pas definitief na onze bevestiging.</p>
      </div>
      <div class="contact-form-panel">
        <h3>Laat van je horen.</h3>
        <?php include __DIR__ . '/includes/contact-form.php'; ?>
      </div>
    </div>
  </section>
</main>

<footer class="site-footer">
  <div class="footer-invitation"><p>Tot straks<br><em>bij De Pasto.</em></p><a class="btn secondary" href="#contact">Een vraag of reservatie? <span aria-hidden="true">↗</span></a></div>
  <div class="footer-main">
    <div><a class="footer-brand" href="#top">De Pasto</a><p>De gezelligste huiskamer van Kapellen</p></div>
    <address>Oude Pastorij<br>Dorpsstraat 45 · 2950 Kapellen<br><a href="mailto:info@de-pasto.be">info@de-pasto.be</a></address>
    <a class="back-to-top" href="#top">Terug naar boven <span aria-hidden="true">↑</span></a>
  </div>
  <div class="footer-bottom"><span>© <?= date('Y') ?> De Pasto · Team Pasto</span><span>BTW BE1036.699.079</span><span>Met goesting, in Kapellen.</span></div>
</footer>

<nav class="mobile-cta" aria-label="Snel naar">
  <a href="#dranken">Dranken</a><a href="#eten">Pasta &amp; snacks</a><a href="#contact">Contact <span aria-hidden="true">↗</span></a>
</nav>
<dialog class="gallery-dialog" aria-labelledby="gallery-dialog-title">
  <div class="gallery-dialog-top">
    <h2 id="gallery-dialog-title">Even binnenkijken</h2>
    <button class="gallery-close" type="button" autofocus>Sluiten <span aria-hidden="true">×</span></button>
  </div>
  <figure class="gallery-dialog-figure">
    <img class="gallery-dialog-image" alt="" decoding="async">
    <figcaption class="gallery-dialog-caption"></figcaption>
  </figure>
  <div class="gallery-dialog-bottom">
    <button class="gallery-previous" type="button" aria-label="Vorige foto">← Vorige</button>
    <p class="gallery-status" role="status" aria-live="polite"></p>
    <button class="gallery-next" type="button" aria-label="Volgende foto">Volgende →</button>
  </div>
</dialog>
<script src="<?= $assetVersion('assets/js/main.js') ?>" defer></script>
<script src="<?= $assetVersion('assets/js/experience.js') ?>" defer></script>
</body>
</html>
