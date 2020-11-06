<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
var_dump($_SESSION);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">
  <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/starter-template/">

  <title>Pizza par vous</title>



  <link href="assets/css/app.css" rel="stylesheet">

</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Ta pizza en vente chez nous</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php if (isset($_SESSION['auth'])) : ?>
            <li><a href="logout.php">Se déconnecter</a></li>
          <?php else : ?>
            <li class="active"><a href="register.php">S'inscrire</a></li>
            <li><a href="login.php">Se connecter</a></li>
          <?php endif; ?>
          <li><a href="newpizza.php">Proposer une nouvelle recette</a></li>
          <li><a href="listpizza.php">Voir vos recettes</a></li>
          <li><a href="adjustpizza.php">Modifier une de vos recette</a></li>
          <li><a href="deletepizza.php">Supprimer une de vos recettes</a></li>

          <!--
              <li><a href="#">Contact</a></li> 
         -->
        </ul>
      </div>
      <!--/.nav-collapse -->

  </nav>

  <div class="container">



    <h1>La pizzeria qui vous propose de challenger vos idées de pizza</h1>
    <ul>
      <li>Pour se faire il vous faut créer un compte et nous soumettre votre pizza.</li>
      <li>Si suffisamenent de personnes précommande cette pizza nous la fabriquerons et la mettons à notre carte.</li>
      <li>Bien entendu vous serez la première personne à la deguster.</li>
    </ul>
    <?php if (isset($_SESSION['flash'])) : ?>
      <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>">
          <?= $message; ?>
        </div>
      <?php endforeach; ?>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>