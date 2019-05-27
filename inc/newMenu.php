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
</head>

<body >
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 nav-pills nav-justified">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Aviabacus | Admin</a>
    <a class="nav-item nav-link " href="#"> Avions</a>
    <a class="nav-item nav-link " href="#">Club</a>
    <a class="nav-item nav-link active" href="#">Gestion</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">
                <span data-feather="log-out"></span> Déconnexion</a>
        </li>
    </ul>
</nav>


<div class="container-fluid">
    <div class="row">
        <!-- Menu lateral -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Comptes pilotes</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="user-minus"></span>
                            Comptes débiteurs <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="user-plus"></span>
                            Comptes créditeurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="user"></span>
                            Comptes à zéro
                        </a>
                    </li>

                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Trésorerie</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="dollar-sign"></span>
                            Opérations non-validées
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="book-open"></span>
                            Gestion des bordereaux
                        </a>
                    </li>
                </ul>
                <ul class="nav flex-column mb-2 mt-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="save"></span>
                            Sauvegarde de la  base
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="align-left"></span>
                            Liste des OD
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Titre de la page</h1>
            </div>

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



