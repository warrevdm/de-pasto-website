# De Pasto website

Lichte PHP-website voor De Pasto in de Oude Pastorij, Kapellen. Geen buildstap, database, trackers, sessies of cookies. Montserrat en Playfair Display worden lokaal geladen vanuit `assets/fonts/`, inclusief hun OFL-licenties. Er zijn geen externe fontverzoeken.

## Bestanden

- `index.php`: homepage, SEO/Schema.org en openingsuren.
- `includes/drinks-section.php`: volledige drankenkaart. Bestaande prijsvelden in de bron worden **niet weergegeven**.
- `includes/food-section.php`: pasta en snacks, zonder prijzen.
- `includes/contact-form.php`: contactformulier naar **info@de-pasto.be**.
- `assets/css/style.css`, `drinks-menu.css`, `food-menu.css`: de drie actieve stylesheets.
- `assets/js/main.js`: toegankelijke mobiele navigatie, fotoslider, subtiele animaties en dagmarkering.
- `assets/img/gallery/`: originele foto's; `assets/img/optimized/`: responsieve WebP-versies.
- `assets/de-pasto-favicon/`: faviconbestanden en manifest.

Het oude `menu-upgrades.css` blijft beschikbaar maar wordt niet meer ingeladen: de eetkaart heeft nu één eigen stylesheet. De PHP-includes blijven de bron voor de menu's; er is geen tweede menukaart in JavaScript.

## Lokaal en hosting

Gebruik een ondersteunde PHP 8-versie. In XAMPP staat het project bijvoorbeeld in `C:\xampp\htdocs\de-pasto-website`; open `http://localhost/de-pasto-website/` met Apache actief.

```bash
git pull origin main
```

Upload vervolgens `index.php`, `includes/` en `assets/` naar dezelfde PHP-hosting. Upload ook de nieuwe map `assets/img/optimized/`. Publiceer geen financiële of concessiedocumenten; die maken geen deel uit van deze repo.

Stylesheets en JavaScript krijgen automatisch een versieparameter op basis van de wijzigingsdatum. Wis eventueel de hosting/CDN-cache en herlaad met Ctrl+F5. Het favicon gebruikt nu het bestaande pad onder `assets/de-pasto-favicon/`, ook correct in een lokale submap.

De canonical en social metadata blijven op `https://www.de-pasto.be/` staan. Laat de hosting HTTP en het domein zonder www naar deze HTTPS-versie doorverwijzen, of pas alle canonical/OG/Schema-URL's consequent aan als het hoofddomein wijzigt. Originele JPEG-foto's blijven beschikbaar voor de bestaande OG-image.

## Contactmail controleren

Het formulier verzendt naar `info@de-pasto.be` met afzender `website@de-pasto.be`; antwoorden gaan naar het ingevulde e-mailadres. Configureer die afzender en de bijbehorende SPF/DKIM-instellingen bij de mailprovider.

- Alleen een geslaagde `mail()`-aanroep geeft een bevestiging. Dit betekent dat de server de mail heeft aangenomen, geen garantie van aflevering in de inbox.
- Bij `false`, een ontbrekende/uitgeschakelde functie of een uitzondering verschijnt een foutmelding en blijven geldige invoervelden ingevuld.
- Blokkeert de hosting PHP `mail()` of is de aflevering onbetrouwbaar? Configureer geauthenticeerde **SMTP**, bijvoorbeeld met **PHPMailer**, en bewaar inloggegevens buiten de publieke map en Git.
- Test na upload één echt bericht en controleer inbox én spam. Een lokale XAMPP-installatie heeft meestal nog geen mailtransport.
- Een reservatie via het formulier is pas definitief nadat De Pasto ze bevestigt.

## Onderhoud

Wijzig openingsuren zowel in `$hours` als in `openingHoursSpecification` in `index.php`. Prijzen horen niet in de zichtbare menu's of structured data. Respecteer bij nieuwe foto's beschrijvende alt-teksten, vaste afmetingen en lazy loading buiten de hero. De inhoud, menu-uitklappers en contactvelden werken ook zonder JavaScript; reduced-motion schakelt de automatische slider en animaties uit.
