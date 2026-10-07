<?php
$sent = false;
$error = '';
$name = '';
$email = '';
$message = '';
$reservationDate = '';
$reservationTime = '';
$reservationGuests = '';
$topics = ['vraag' => 'Een vraag', 'reservatie' => 'Een reservatie', 'samenwerking' => 'Een samenwerking'];
$topic = 'vraag';
$reservationTimezone = new DateTimeZone('Europe/Brussels');
$reservationToday = new DateTimeImmutable('today', $reservationTimezone);
$reservationLatest = $reservationToday->modify('+1 year');
$reservationMin = $reservationToday->format('Y-m-d');
$reservationMax = $reservationLatest->format('Y-m-d');

$escape = static function ($value) {
  return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$textLength = static function ($value) {
  return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
};

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  // Only accept strings: crafted array fields must never crash the page.
  $validFields = true;
  foreach (['name', 'email', 'message', 'website', 'topic', 'reservation_date', 'reservation_time', 'reservation_guests'] as $field) {
    if (isset($_POST[$field]) && !is_string($_POST[$field])) {
      $validFields = false;
    }
  }

  $name = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
  $email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
  $message = is_string($_POST['message'] ?? null) ? trim($_POST['message']) : '';
  $website = is_string($_POST['website'] ?? null) ? trim($_POST['website']) : '';
  $topic = is_string($_POST['topic'] ?? null) ? $_POST['topic'] : 'vraag';
  $reservationDate = is_string($_POST['reservation_date'] ?? null) ? trim($_POST['reservation_date']) : '';
  $reservationTime = is_string($_POST['reservation_time'] ?? null) ? trim($_POST['reservation_time']) : '';
  $reservationGuests = is_string($_POST['reservation_guests'] ?? null) ? trim($_POST['reservation_guests']) : '';
  $parsedReservationDate = null;
  if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/D', $reservationDate)) {
    $parsedReservationDate = DateTimeImmutable::createFromFormat('!Y-m-d', $reservationDate, $reservationTimezone);
  }
  // DateTime normalizes impossible dates, so require an exact round trip as well.
  $validReservationDate = $parsedReservationDate !== false && $parsedReservationDate !== null &&
    $parsedReservationDate->format('Y-m-d') === $reservationDate &&
    $parsedReservationDate >= $reservationToday && $parsedReservationDate <= $reservationLatest;

  if (!$validFields || !isset($topics[$topic])) {
    $topic = 'vraag';
    $error = 'We konden je gegevens niet verwerken. Vul het formulier opnieuw in.';
  } elseif ($website !== '') {
    $error = 'Je bericht kon niet worden verstuurd. Mail ons rechtstreeks via info@de-pasto.be.';
  } elseif (
    $name === '' || ($topic !== 'reservatie' && $message === '') ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    preg_match('/[\r\n\x00]/', $name . $email) ||
    strpos($message, "\0") !== false
  ) {
    $error = $topic === 'reservatie'
      ? 'Vul je naam en een geldig e-mailadres in. Vermijd ongebruikelijke tekens in je gegevens.'
      : 'Vul je naam, geldig e-mailadres en bericht in.';
  } elseif ($textLength($name) > 120 || strlen($email) > 254 || $textLength($message) > 5000) {
    $error = 'Gebruik maximaal 120 tekens voor je naam, 254 voor je e-mailadres en 5.000 voor je bericht.';
  } elseif ($topic === 'reservatie' && !$validReservationDate) {
    $error = 'Kies een geldige reservatiedatum vanaf vandaag en binnen het komende jaar.';
  } elseif ($topic === 'reservatie' && !preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/D', $reservationTime)) {
    $error = 'Kies een geldig tijdstip voor je reservatie, bijvoorbeeld 18:30.';
  } elseif ($topic === 'reservatie' && !preg_match('/^[1-9][0-9]?$/D', $reservationGuests)) {
    $error = 'Vul een heel aantal personen in tussen 1 en 99. We bevestigen de mogelijkheden persoonlijk.';
  } else {
    $to = 'info@de-pasto.be';
    $subject = 'De Pasto website: ' . $topics[$topic];
    $body = "Je ontving een nieuw bericht via de website van De Pasto.\n\n";
    $body .= "Onderwerp: {$topics[$topic]}\n";
    $body .= "Naam: {$name}\n";
    $body .= "E-mail: {$email}\n\n";
    if ($topic === 'reservatie') {
      $body .= 'Gewenste datum: ' . $parsedReservationDate->format('d/m/Y') . "\n";
      $body .= "Gewenst tijdstip: {$reservationTime}\n";
      $body .= "Aantal personen: {$reservationGuests}\n";
      $body .= "Dit is een aanvraag; de reservatie is pas definitief na bevestiging door De Pasto.\n\n";
    }
    $body .= "Bericht:\n" . ($message !== '' ? $message : '(Geen extra wensen opgegeven.)') . "\n";

    $headers = [
      'From: De Pasto Website <website@de-pasto.be>',
      'Reply-To: ' . $email,
      'MIME-Version: 1.0',
      'Content-Type: text/plain; charset=UTF-8',
      'Content-Transfer-Encoding: 8bit',
    ];

    // Hosts may disable mail() entirely or return false when no mail transport is configured.
    // In that case configure authenticated SMTP (for example with PHPMailer) on the server.
    try {
      $sent = function_exists('mail') && @mail($to, $subject, $body, implode("\r\n", $headers));
    } catch (Throwable $exception) {
      $sent = false;
    }

    if ($sent) {
      $name = $email = $message = $reservationDate = $reservationTime = $reservationGuests = '';
      $topic = 'vraag';
    } else {
      $error = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@de-pasto.be.';
    }
  }
}
?>
<form class="contact-form" method="post" action="#contact" aria-label="Contactformulier" data-contact-form>
  <?php if ($sent): ?>
    <p class="form-feedback form-success" role="status" tabindex="-1" data-form-feedback>Bedankt voor je bericht! Een reservatie is pas definitief na onze bevestiging.</p>
  <?php elseif ($error !== ''): ?>
    <p class="form-feedback form-error" role="alert" tabindex="-1" data-form-feedback><?= $escape($error) ?></p>
  <?php endif; ?>

  <div class="form-honeypot" hidden>
    <label for="contact-website">Laat dit veld leeg</label>
    <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off" maxlength="200">
  </div>

  <label for="contact-topic">
    Waarover gaat je bericht?
    <select id="contact-topic" name="topic" required>
      <?php foreach ($topics as $value => $label): ?>
        <option value="<?= $escape($value) ?>" <?= $topic === $value ? 'selected' : '' ?>><?= $escape($label) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label for="contact-name">
    Naam <span aria-hidden="true">*</span>
    <input id="contact-name" type="text" name="name" autocomplete="name" maxlength="120" required value="<?= $escape($name) ?>">
  </label>

  <label for="contact-email">
    E-mail <span aria-hidden="true">*</span>
    <input id="contact-email" type="email" name="email" autocomplete="email" maxlength="254" required value="<?= $escape($email) ?>">
  </label>

  <fieldset class="reservation-fields" data-reservation-fields>
    <legend>Je reservatieaanvraag</legend>
    <p class="form-note" id="contact-reservation-note">Vul deze velden alleen in voor een reservatie. Je gewenste datum, tijdstip en aantal personen zijn dan verplicht. We bevestigen de beschikbaarheid persoonlijk.</p>
    <div class="reservation-grid">
      <label for="contact-date">
        Gewenste datum <span aria-hidden="true">*</span>
        <input id="contact-date" type="date" name="reservation_date" min="<?= $escape($reservationMin) ?>" max="<?= $escape($reservationMax) ?>" value="<?= $escape($reservationDate) ?>" aria-describedby="contact-reservation-note">
      </label>
      <label for="contact-time">
        Gewenst tijdstip <span aria-hidden="true">*</span>
        <input id="contact-time" type="time" name="reservation_time" step="60" value="<?= $escape($reservationTime) ?>" aria-describedby="contact-reservation-note">
      </label>
      <label for="contact-guests">
        Aantal personen <span aria-hidden="true">*</span>
        <input id="contact-guests" type="number" name="reservation_guests" min="1" max="99" step="1" inputmode="numeric" value="<?= $escape($reservationGuests) ?>" aria-describedby="contact-reservation-note">
      </label>
    </div>
  </fieldset>

  <label for="contact-message">
    <span data-message-label>Bericht</span> <span aria-hidden="true" data-message-required>*</span>
    <textarea id="contact-message" name="message" rows="5" maxlength="5000" aria-describedby="contact-form-note"><?= $escape($message) ?></textarea>
  </label>

  <p class="form-note" id="contact-form-note">Naam en e-mail zijn verplicht. Een bericht is verplicht voor een vraag of samenwerking; bij een reservatie mag je extra wensen toevoegen. Je reservatie is pas definitief na onze bevestiging.</p>
  <button class="btn primary" type="submit"><span class="contact-submit-label" data-submit-label>Verstuur bericht</span> <span aria-hidden="true">↗</span></button>
</form>
