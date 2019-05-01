<?php 
  if(session_status() == PHP_SESSION_NONE){
  session_start(); 
} 
?>
<!DOCTYPE html>
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

    <title>Mon super projet</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/style.css" rel="stylesheet">

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
          <a class="navbar-brand" href="#">Aviabacus 2</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

            <!--Menu spécfique aux utilisateurs loggés -->
            <?php if(isset($_SESSION['auth'])): ?>
            <li><a href="../page/account.php">Compte</a></li>

              <!--Menu spécifique au pilote -->
              <?php if($_SESSION['auth']->lvl_user == 'Pilote'): ?>
                <li><a href="../page/pilote.php">Vol</a></li>
              <?php endif; ?>

              <!--Menu spécifique au chef-pilote -->


              <!--Menu spécifique au Trésorier -->
              

              <!--Menu spécifique au Bureau -->

              
              <!--Menu spécifique à l'administrateur -->
              <?php if($_SESSION['auth']->lvl_user == 'Administrateur'): ?>
                <li><a href="../page/pilote.php">Admin</a></li>
              <?php endif; ?>


            <li><a href="../page/account-parametres.php">Paramètres</a>
            <li><a href="../page/logout.php">Se deconnecter</a></li>

            <!--Menu spécifique aux utilisateurs non logués -->
          <?php else: ?>
            <li ><a href="../page/register.php">S'inscrire</a></li>
            <li><a href="../page/login.php">Se connecter</a></li>
          <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
    <?php if(isset($_SESSION['flash'])): ?>

      <?php foreach($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type; ?>">
          <?= $message; ?>
        </div>

      <?php endforeach; ?>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    
