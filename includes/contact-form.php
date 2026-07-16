<?php
$sent = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
    $error = 'Vul je naam, geldig e-mailadres en bericht in.';
  } else {
    $to = 'info@de-pasto.be'; // Pas aan naar jullie echte e-mailadres
    $subject = 'Nieuw bericht via De Pasto website';
    $body = "Naam: $name\nE-mail: $email\n\nBericht:\n$message";
    $headers = "From: website@de-pasto.be\r\nReply-To: $email\r\n";
    // Zet mail() aan op hosting. Lokaal werkt dit vaak niet zonder mailserver.
    // $sent = mail($to, $subject, $body, $headers);
    $sent = true;
  }
}
?>
<form class="contact-form" method="post" action="#contact">
  <?php if ($sent): ?><p class="form-success">Bedankt! Je bericht werd goed ontvangen.</p><?php endif; ?>
  <?php if ($error): ?><p class="form-error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <label>Naam <input type="text" name="name" required></label>
  <label>E-mail <input type="email" name="email" required></label>
  <label>Bericht <textarea name="message" rows="5" required></textarea></label>
  <button class="btn primary" type="submit">Verstuur bericht</button>
</form>
