<?php
session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = 'Vous êtes déconnecté';

/* sur les serveurs promo
$mail = mail('essai.bla@bla.fr', 'Vous vous êtes bien déconnecté(e)', 'Vous êtes déconnecté', 'From: alexandre.fournier@yahoo.fr');
*/

require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
  ->setUsername('0045f52cb02d7c')
  ->setPassword('cca8612601f2df')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Vous vous êtes bien déconnecté(e)'))
  ->setFrom(['alexandre.fournier@yahoo.fr' => 'Alef'])
  ->setTo(['essai.bla@bla.fr'])
  ->setBody('Vous êtes déconnecté(e)')
  ;

// Send the message
$result = $mailer->send($message);


header('Location: login.php');