<?php
$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $message = trim($_POST['message'] ?? '');

  // Basis anti-header-injection
  $name = str_replace(["\r", "\n"], ' ', $name);
  $email = str_replace(["\r", "\n"], '', $email);

  if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
    $error = 'Vul je naam, geldig e-mailadres en bericht in.';
  } else {
    $to = 'info@de-pasto.be';
    $subject = 'Nieuw bericht via De Pasto website';

    $body = "Je ontving een nieuw bericht via de website van De Pasto.\n\n";
    $body .= "Naam: {$name}\n";
    $body .= "E-mail: {$email}\n\n";
    $body .= "Bericht:\n{$message}\n";

    $headers = [];
    $headers[] = 'From: De Pasto Website <website@de-pasto.be>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/plain; charset=UTF-8';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    $sent = mail($to, $subject, $body, implode("\r\n", $headers));

    if (!$sent) {
      $error = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@de-pasto.be.';
    }
  }
}
?>
<form class="contact-form" method="post" action="#contact">
  <?php if ($sent): ?>
    <p class="form-success">Bedankt! Je bericht werd goed verzonden.</p>
  <?php endif; ?>

  <?php if ($error): ?>
    <p class="form-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
  <?php endif; ?>

  <label>
    Naam
    <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  </label>

  <label>
    E-mail
    <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  </label>

  <label>
    Bericht
    <textarea name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
  </label>

  <button class="btn primary" type="submit">Verstuur bericht</button>
</form>
