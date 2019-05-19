<?php
require "../../inc/functions.php";
require '../../inc/bootstrap.php';
session_start();
//reconnect_cookie();
if (!empty($_POST) &&  !empty($_POST['password'])) {
    sleep(1); // Une pause de 1 sec afin de ralentir les tentatives de brute force
    $db = App::getDatabase();
    $user = $db->query('SELECT * FROM t_pilote WHERE email= ? && confirmed_at IS NOT null', [$_POST['email']])->fetch();

    //comparaison du mot de passe tapé et du mot de passe dans la BDD (celui stocké étant haché)
    if(password_verify($_POST['password'], $user->password)){
        session_start();
        $_SESSION['auth']=$user;
        $_SESSION['flash']['success']='Vous êtes maintenant bien connecté sur Aviabacus';

        /*if ($_POST['remember']) {
            # code...
            $remember_token=str_random(250);
            $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

            setcookie('remember', $user->id.'=='.$remember_token.sha1($user->id .  'ratonlaveurs'), time() + 60 * 60 * 24 * 7);

        }*/
        header('Location: accueil.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect!';
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Aviabacus 2</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/signin.css" rel="stylesheet">
    <link href="../../css/floating-labels.css" rel="stylesheet">
    <link href="../../css/footer.css" rel="stylesheet">

</head>

<body class="text-center">

<form class="form-signin" method="post" action="">
    <?php if(isset($_SESSION['flash'])): ?>

        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>

        <?php endforeach; ?>
        <?php unset($_SESSION['flash']);

        ?>
    <?php endif; ?>
    <!--<img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
    <h1 class="h3 mb-3 font-weight-normal">Se connecter : </h1>
    <label for="inputEmail" class="sr-only">Adresse mail</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div> -->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
    <a href="forget.php">Mot de passe oublié</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>
<footer class="footer">
    <div class="container">
        <span class="text-muted" id="info_footer"><a href="https://goo.gl/maps/UXKEFi9rLEVqk4wD6" title="Google Maps" target="_blank">Aéroclub Pierre Trébod  - Aérodrome de Saint-Cyr-l'École - 78210 Saint-Cyr-l'École</a> - Téléphone : 01 30 45 06 76</span>
    </div>
</footer>
</body>
</html>