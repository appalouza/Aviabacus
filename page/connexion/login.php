<?php
require "../../inc/functions.php";
require '../../inc/bootstrap.php';
session_start();

define('SITE_KEY', '6LdRc6UUAAAAAG4ljA_vPDkFkPOmm3oYSJhWEakk');
define('SECRET_KEY', '6LdRc6UUAAAAAFRtJYaVoY0gGdAjZeCkqYjFn9Ro');

//reconnect_cookie();
//test du contenu de la variable $_POST
if (!empty($_POST) &&  !empty($_POST['password'])) {

    //récupération de la réponse du captcha
    $Return = getCaptcha($_POST['g-recaptcha-response']);



    //test du succès ou non du captcha, ainsi que du score, si il est en dessous de 0.5, alors il y à de grande chance que ce soit un robot
    if ($Return->success == true && $Return->score >0.5){

        // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
        $Email = htmlentities($_POST['email'], ENT_QUOTES, "ISO-8859-1");
        $MotDePasse = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");

        //connection à la bdd et récupération des données de l'utilisateur correspondant à l'email
        $db = App::getDatabase();
        $user = $db->query('SELECT * FROM t_pilote WHERE email= ?  && confirmed_at IS NOT null', [$Email])->fetch();

        //comparaison du mot de passe tapé et du mot de passe dans la BDD (celui stocké étant haché)
        if($user != null && password_verify($MotDePasse, $user->password)){
            session_start();
            $_SESSION['auth']=$user;
            $_SESSION['flash']['success']='Vous êtes maintenant bien connecté sur Aviabacus';

            /*if ($_POST['remember']) {
                # code...
                $remember_token=str_random(250);
                $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

                setcookie('remember', $user->id.'=='.$remember_token.sha1($user->id .  'ratonlaveurs'), time() + 60 * 60 * 24 * 7);

            }*/
            //redirection vers la page d'accueil
            header('Location: accueil.php');
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect!';
        }
    }
    else{
        echo "you are a robot";
        die();
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
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY;?>"></script>

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
    <input type="hidden" id = "g-recaptcha-response" name="g-recaptcha-response"/><br/>
    <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div> -->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
    <a href="forget.php">Mot de passe oublié</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo SITE_KEY;?>', {action: 'homepage'}).then(function(token) {
        console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
        });
    });
</script>



<footer class="footer">
    <div class="container">
        <span class="text-muted" id="info_footer"><a href="https://goo.gl/maps/UXKEFi9rLEVqk4wD6" title="Google Maps" target="_blank">Aéroclub Pierre Trébod  - Aérodrome de Saint-Cyr-l'École - 78210 Saint-Cyr-l'École</a> - Téléphone : 01 30 45 06 76</span>
    </div>
</footer>
</body>
</html>