<?php
require_once '../inc/bootstrap.php'; ?>

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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

      <script src="../js/jquery-slim.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />

    <title>Aviabacus 2</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.css" rel="stylesheet">
      <link href="../css/footer.css" rel="stylesheet">


  </head>

  <body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      <div class="container">
        <div class="navbar-header">

         <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
-->
        </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

            <!--Menu spécfique aux utilisateurs loggés -->
            <?php if(isset($_SESSION['auth'])): ?>
              <a class="nav-link" href="../page/connexion/accueil.php">Aviabacus 2</a>
             <!--Menu spécifique au pilote -->
              <?php if($_SESSION['auth']->level_user == 'Pilote'): ?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Vol
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="../page/avion/planche_vol.php">Informations sur les vols</a></p>
                          <a class="dropdown-item" href="../page/Fiche_de_saisie_avant_vol.php">Fiche de saisie avant vol</a>

                      </div>
                  </li>
              <?php endif; ?>

              <!--Menu spécifique au chef-pilote -->


              <!--Menu spécifique au Trésorier -->
              

              <!--Menu spécifique au Bureau -->

              
              <!--Menu spécifique à l'administrateur -->
              <?php if($_SESSION['auth']->level_user == 'Administrateur'): ?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Vol
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="../page/avion/planche_vol.php">Informations sur les vols</a></p>
                          <a class="dropdown-item" href="../page/Fiche_de_saisie_avant_vol.php">Fiche de saisie avant vol</a>

                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Admin
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="../page/avion/planche_vol.php">Accès aux vols</a>
                          <a class="dropdown-item" href="../page/info_user/fiche_pilote.php">Fiche formation pilote</a>
                          <a class="dropdown-item" href="../page/Inscription_coordonnées.php">Inscription d'un nouveau pilote</a>
                          <a class="dropdown-item" href="../page/info_user/Modification_user.php">Modification d'un utilisateurs</a>
                          <a class="dropdown-item" href="../page/inscription_user/info_med.php">Renseignement médicaux d'un pilote</a>
                          <a class="dropdown-item" href="../page/avion/Liste_Avion.php">Liste des avions</a>

                      </div>
                  </li>

              <?php endif; ?>

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Paramètres
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="../page/connexion/update-pwd.php">Changement du mot de passe</a>
                          <a class="dropdown-item" href="../page/connexion/update-pwd.php">Contacter le suppport</a>


                      </div>
                  </li>
          </ul>
                <ul class="nav navbar-nav navbar-right">
            <li><a class="nav-link" href="">Bonjour <?= $_SESSION['auth']->prenom; ?></a> </li>
            <li><a class="nav-link" href="../page/connexion/logout.php">Se déconnecter</a></li>
                </ul>


            <!--Menu spécifique aux utilisateurs non logués -->
          <!--
            <li ><a href="../page/register.php">S'inscrire</a></li>
            <li><a href="../page/login.php">Se connecter</a></li>-->
          <?php endif; ?>

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
            <?php unset($_SESSION['flash']);

          ?>
        <?php endif; ?>
