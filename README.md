# De Pasto website

Warme, verfijnde PHP-website voor De Pasto in de Oude Pastorij in Kapellen. De vormgeving volgt de gedrukte menukaart: olijfgroen, sage, zand en crème, met lokaal geladen Playfair Display en Montserrat. Geen buildstap, database, trackers, sessies of cookies.

## Opbouw

De homepage leidt bezoekers van de sfeer en het verhaal naar de kaart, foto's, samenwerking met Buitengewoon VZW, openingsuren, praktische vragen en contact. Bestaande links naar `#dranken`, `#eten`, `#sfeer`, `#uren`, `#social` en `#contact` blijven bruikbaar. De hoofdnavigatie heeft vijf onderdelen en een aparte knop om een tafel aan te vragen. Op mobiel staan de kaart, bezoekinformatie en tafel aanvragen binnen handbereik.

- `index.php`: pagina, navigatie, foto's en SEO/Schema.org.
- `includes/site-data.php`: één bron voor de zeven openingsdagen, gebruikt door de zichtbare tabel én Schema.org.
- `includes/drinks-section.php`: drankenkaart en aanvullende productdetails uit het aangeleverde menu van september 2026.
- `includes/food-section.php`: pasta, snacks, pannenkoeken en chips.
- `includes/contact-form.php`: contactformulier naar `info@de-pasto.be`, met onderwerp vraag, reservatie of samenwerking.
- `assets/css/style.css`: globale typografie, layout, responsiviteit, fotovergroting en toegankelijkheid.
- `assets/css/drinks-menu.css` en `food-menu.css`: de afzonderlijke menucomponenten.
- `assets/css/features.css`: alleen aanvullende controls; de bestaande visuele stijl en `style.css` blijven behouden.
- `assets/css/hero.css`: de interactieve hoofdbanner, binnen dezelfde kleuren en typografie.
- `assets/js/main.js`: mobiele navigatie, actieve sectie, dagmarkering en directe links naar menu/contact.
- `assets/js/hero.js`: drie handmatig gekozen scènes, bijpassende links, veegbediening en subtiele muisbeweging.
- `assets/js/experience.js`: drankenzoeker, snelle filters en deelbare selecties.
- `assets/js/gallery.js`: toegankelijke fotovergroting, miniaturen en veegbediening.
- `assets/js/contact.js`: voorwaardelijke reservatievelden, veldhulp en verzendstatus.
- `assets/img/gallery/`: oorspronkelijke foto's; `assets/img/optimized/`: responsieve WebP-versies.
- `assets/fonts/`: lokale lettertypes met OFL-licenties.

## Lokaal en hosting

Gebruik een ondersteunde PHP 8-versie. Voor lokaal bekijken:

```bash
php -S localhost:8080
```

Open vervolgens `http://localhost:8080`. In XAMPP kan de repo in `C:\xampp\htdocs\de-pasto-website` staan.

Upload voor productie `index.php`, `includes/` en `assets/` naar de bestaande PHP-hosting. Neem alle nieuwe WebP-bestanden en `includes/site-data.php` mee. Het GitHub-project heeft geen automatische deployment: een commit of pull request publiceert op zichzelf geen nieuwe website. Financiële en concessiedocumenten horen niet in deze publieke repository.

Stylesheets en JavaScript krijgen automatisch een versieparameter op basis van hun wijzigingsdatum. Wis zo nodig de hosting/CDN-cache. Faviconpaden werken ook vanuit een lokale submap.

Canonical en social metadata gebruiken `https://www.de-pasto.be/`. Laat de hosting HTTP en het domein zonder www consequent naar die HTTPS-versie doorsturen, of wijzig alle SEO-URL's samen wanneer het hoofddomein verandert.

## Inhoud onderhouden

Wijzig openingsuren uitsluitend in `includes/site-data.php`. De aangeleverde kaart vermeldt op vrijdag en zaterdag sluiting om **02:00**; die uren zijn hier overgenomen. De uitzonderingen 25 december en 1 januari en de keuken-/snackuren staan bij de bezoekinformatie. De dagmarkering gebruikt de tijdzone `Europe/Brussels` en doet geen automatische uitspraak of de zaak op dat moment open is.

Prijzen worden niet op de website weergegeven. De menu-includes bevatten alleen namen en omschrijvingen, met 91 dranken en 14 eetkaartregels. Wijzig het assortiment daar, zodat er geen tweede menu in JavaScript ontstaat. Productdetails zoals theesmaken en siropen worden meegenomen in de zoeker.

Nieuwe foto's krijgen beschrijvende alt-teksten, vaste afmetingen, responsieve WebP-bronnen en lazy loading buiten de hero. De hero gebruikt de bestaande foto's van de Pastorij, tuin en interieur. Zonder JavaScript blijven de kaart, navigatie, praktische vragen en contactformulier bruikbaar; fotolinks openen de originele bestanden.

## Interactie en toegankelijkheid

De drankenzoeker is hoofdletter- en accentongevoelig. Snelle filters voor koffie/thee, bieren, apero en expliciet alcoholvrije keuzes werken samen met de zoekterm. Wissen herstelt eerder geopende categorieën en zet de filter terug. De momentkaarten koffie en apero filteren de passende drankenrubriek.

“Kopieer deze selectie” kopieert een link met alleen `drank` en `filter` naar het klembord. Bij ontbrekende klembordtoegang verschijnt een selecteerbaar linkveld. De ontvanger krijgt dezelfde kaartselectie te zien. Er wordt niets verzonden en geen bezoekgeschiedenis opgeslagen. De zoeker begrenst zoektermen tot 120 tekens en accepteert alleen bekende filterwaarden.

Een reservatieknop kiest het bijbehorende formulieronderwerp zonder ingevulde tekst te vervangen. Bij een reservatie toont het formulier datum, tijdstip en aantal personen; extra wensen zijn optioneel. Bij een vraag of samenwerking blijft het bericht verplicht. JavaScript verbergt alleen niet-relevante velden; zonder JavaScript staat bij de extra velden duidelijk waarvoor ze nodig zijn. PHP valideert dezelfde voorwaarden, echte datums vanaf vandaag tot één jaar vooruit in Europe/Brussels, een 24-uurs tijdstip en een heel aantal personen van 1 tot 99. Dit is een invoergrens, geen toezegging over capaciteit of beschikbaarheid.

De fotogalerij gebruikt een native dialoog met vorige/volgende, pijltjestoetsen, Home/End, miniaturen, veegbediening en Escape. De focus keert terug naar de aangeklikte foto. De vergrote foto gebruikt geoptimaliseerde WebP; bij fouten blijft de kleinere foto zichtbaar. Alleen de twee aangrenzende 960px-beelden worden op de achtergrond voorbereid, met respect voor databesparing.

De hoofdbanner laat bezoekers kiezen tussen de tuin, de bar en de avond. Foto, korte omschrijving en bijpassende link wisselen samen; de naam en subtiele slogan blijven vast. De koffie- en aperolinks zetten direct de passende drankenrubriek klaar. Er is geen automatische rotatie. Alleen een gekozen scène laadt een volgende grote foto; de miniaturen gebruiken kleinere WebP-bestanden. Een mislukte of verouderde fotoaanvraag overschrijft de huidige scène niet.

De drie keuzes werken met klikken, Tab, pijltjestoetsen en Home/End. Op een aanraakscherm kan je horizontaal over de foto vegen; verticale scroll en pinch-zoom blijven beschikbaar. Alleen bij een fijne muisaanwijzer beweegt de foto maximaal acht pixels mee. Reduced-motion schakelt die beweging en de overgangen uit. Zonder JavaScript blijven de eerste scène en de navigatielinks bruikbaar. De routeknoppen laden Google Maps pas na een klik; er staat geen externe kaartembed op de pagina.

## Contactmail controleren

Het formulier mailt naar `info@de-pasto.be`, met afzender `website@de-pasto.be` en het ingevulde adres als Reply-To. Configureer de afzender en SPF/DKIM bij de mailprovider.

- Alleen een geslaagde `mail()`-aanroep geeft bevestiging. Dit betekent serveracceptatie, geen garantie van aflevering in de inbox.
- Bij ontbrekend/uitgeschakeld mailtransport, `false` of een uitzondering toont de pagina een foutmelding en blijven geldige velden ingevuld.
- Voor onbetrouwbaar PHP-mailtransport: configureer geauthenticeerde SMTP, bijvoorbeeld met PHPMailer, en bewaar credentials buiten Git en de publieke map.
- Test na upload één echt bericht en controleer inbox en spam. Een lokaal ontwikkelsysteem heeft doorgaans geen mailtransport.
- Een tafel is pas gereserveerd nadat De Pasto de aanvraag bevestigt.

Servervalidatie controleert onderwerp, naam, e-mailadres, bericht en eventuele reservatiegegevens en weigert arrayvelden en headerinjectie. Het formulier toont veldhulp en voorkomt tijdens het versturen extra klikken; opnieuw laden na een succesvolle POST kan nog altijd opnieuw verzenden. Het honeypotveld helpt tegen eenvoudige bots. Een succesvolle POST wordt niet omgeleid.

## Controle van deze herwerking

PHP- en JavaScript-syntax, browserweergave en interacties zijn gecontroleerd met PHP 8.3 en Chromium op breedtes van 320 tot 1440 pixels. De aanvullende controles omvatten menuselecties, galerijbediening, voorwaardelijke formuliervelden, ongeldige invoer en gegevensbehoud bij ontbrekend mailtransport. De banner krijgt afzonderlijke controles voor toetsenbord, vegen, snelle scènekeuzes, fotolaadfouten en verminderde beweging. De drie bestaande stijlbestanden zijn ongewijzigd; de banner heeft een eigen stylesheet. Controleer voor publicatie ook de uren/kaart en de daadwerkelijke productie-mailaflevering. Het formulier verstuurt een aanvraag; beschikbaarheid wordt persoonlijk bevestigd.

Visuele previews: [desktop](docs/preview-desktop.jpg), [mobiel](docs/preview-mobile.jpg), [banner aan de bar](docs/preview-hero-bar.jpg), [banner in de avond](docs/preview-hero-avond.jpg), [kaartfilters](docs/preview-menu.jpg), [fotogalerij](docs/preview-gallery.jpg) en [reservatieaanvraag](docs/preview-reservation.jpg).
