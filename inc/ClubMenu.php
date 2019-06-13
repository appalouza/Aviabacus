<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="../../js/jquery-slim.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />

    <title>Aviabacus 2</title>

    <!-- Bootstrap core CSS -->

    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/footer.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body >
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 nav-pills nav-justified">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../../page/connexion/accueil.php">Aviabacus | <?php echo $_SESSION['auth']->level_user;?></a>
    <a class="nav-item nav-link " href="../../page/avion/Liste_Avion.php"> Avions</a>
    <a class="nav-item nav-link active" href="../../page/info_user/Liste_User.php">Club</a>
    <a class="nav-item nav-link" href="../../page/info_user/ComptePiloteDebiteurs.php">Gestion</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="../../page/connexion/logout.php">
                <span data-feather="log-out"></span> Déconnexion</a>
        </li>
    </ul>
</nav>


<div class="container-fluid">
    <div class="row">
        <!-- Menu lateral -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../page/info_user/Liste_User.php">
                            <span data-feather="user"></span>
                            Liste des membres <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../page/info_user/Liste_User.php">
                            <span data-feather="user"></span>
                            Liste des membres <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../page/info_user/listeElevePilote.php">
                            <span data-feather="user"></span>
                            Liste des élèves pilotes <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../page/info_user/presenceCours.php">
                            <span data-feather="list"></span>
                            Présence aux cours théoriques <span class="sr-only"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            <!-- Contenu page-->
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


