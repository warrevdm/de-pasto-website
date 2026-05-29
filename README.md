# De Pasto website

Bestanden:
- `index.php` — hoofdpagina
- `includes/contact-form.php` — PHP-contactformulier
- `assets/css/style.css` — huisstijl en layout
- `assets/js/main.js` — mobiel menu en animaties

Aanpassen:
1. Vervang in `includes/contact-form.php` het e-mailadres `info@depasto.be`.
2. Zet in productie `$sent = mail(...)` terug actief en verwijder/overschrijf de testregel `$sent = true;`.
3. Upload de map naar PHP-hosting.

Gebruikte stijl:
- Playfair Display voor titels/logo
- Montserrat als body/fallback voor Now-caps
- Kleuren: #384510, #a2b470, #e1ccb1, #fffae7, #ffd863


## Afbeeldingen
De foto's zitten in `assets/img/gallery/` en zijn verwerkt in de hero-slider en de sectie `Sfeerbeelden`.
