<?php
$sent = false;
$error = '';
$name = '';
$email = '';
$message = '';

$escape = static function ($value) {
  return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$textLength = static function ($value) {
  return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
};

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  // Only accept strings: crafted array fields must never crash the page.
  $validFields = true;
  foreach (['name', 'email', 'message', 'website'] as $field) {
    if (isset($_POST[$field]) && !is_string($_POST[$field])) {
      $validFields = false;
    }
  }

  $name = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
  $email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
  $message = is_string($_POST['message'] ?? null) ? trim($_POST['message']) : '';
  $website = is_string($_POST['website'] ?? null) ? trim($_POST['website']) : '';

  if (!$validFields) {
    $error = 'We konden je gegevens niet verwerken. Vul het formulier opnieuw in.';
  } elseif ($website !== '') {
    $error = 'Je bericht kon niet worden verstuurd. Mail ons rechtstreeks via info@de-pasto.be.';
  } elseif (
    $name === '' || $message === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    preg_match('/[\r\n\x00]/', $name . $email) ||
    strpos($message, "\0") !== false
  ) {
    $error = 'Vul je naam, geldig e-mailadres en bericht in.';
  } elseif ($textLength($name) > 120 || strlen($email) > 254 || $textLength($message) > 5000) {
    $error = 'Gebruik maximaal 120 tekens voor je naam, 254 voor je e-mailadres en 5.000 voor je bericht.';
  } else {
    $to = 'info@de-pasto.be';
    $subject = 'Nieuw bericht via De Pasto website';
    $body = "Je ontving een nieuw bericht via de website van De Pasto.\n\n";
    $body .= "Naam: {$name}\n";
    $body .= "E-mail: {$email}\n\n";
    $body .= "Bericht:\n{$message}\n";

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
      $name = $email = $message = '';
    } else {
      $error = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@de-pasto.be.';
    }
  }
}
?>
<form class="contact-form" method="post" action="#contact" aria-label="Contactformulier">
  <?php if ($sent): ?>
    <p class="form-feedback form-success" role="status" tabindex="-1" data-form-feedback>Bedankt! Je bericht is aangeboden aan onze mailserver. Een reservatie is pas definitief na onze bevestiging.</p>
  <?php elseif ($error !== ''): ?>
    <p class="form-feedback form-error" role="alert" tabindex="-1" data-form-feedback><?= $escape($error) ?></p>
  <?php endif; ?>

  <div class="form-honeypot" hidden>
    <label for="contact-website">Laat dit veld leeg</label>
    <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off" maxlength="200">
  </div>

  <label for="contact-name">
    Naam <span aria-hidden="true">*</span>
    <input id="contact-name" type="text" name="name" autocomplete="name" maxlength="120" required value="<?= $escape($name) ?>">
  </label>

  <label for="contact-email">
    E-mail <span aria-hidden="true">*</span>
    <input id="contact-email" type="email" name="email" autocomplete="email" maxlength="254" required value="<?= $escape($email) ?>">
  </label>

  <label for="contact-message">
    Bericht <span aria-hidden="true">*</span>
    <textarea id="contact-message" name="message" rows="5" maxlength="5000" required aria-describedby="contact-form-note"><?= $escape($message) ?></textarea>
  </label>

  <p class="form-note" id="contact-form-note">Alle velden zijn verplicht. Voor een reservatie: vermeld je gewenste datum, uur en aantal personen. Je reservatie is pas definitief na onze bevestiging.</p>
  <button class="btn primary" type="submit">Verstuur bericht <span aria-hidden="true">↗</span></button>
</form>
