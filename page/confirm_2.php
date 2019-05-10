<?php

require_once '../inc/bootstrap.php';
require "../inc/functions.php";
if (!isset($_SESSION['auth'])){
    logout();
}

$user_id = $_GET['id'];
$token = $_GET['token'];
$db = App::getDatabase();
$user = $db->query('SELECT * FROM t_pilote WHERE id = ?',[$user_id] )->fetch();


$validator = new Validator($_POST);
$validator->isPassword('password', "Ce mot de passe n'est pas valide");

if (!empty($_POST)){
    if($validator->isValid() && $user && $user->confirmation_token == $token ){
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $db->query('UPDATE t_pilote SET confirmation_token = NULL, password =?, confirmed_at = NOW() WHERE id = ?',[$password,$user_id] );
        $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
        $_SESSION['auth'] = $user;
        header('Location: ../page/login.php');
    }else{
        $_SESSION['flash']['error'] = "Ce token n'est plus valide";
        header('Location: ../page/login.php');
    }
}

require "../inc/header.php"
?>


    <h4>Veuillez choisir votre mot de passe:</h4>
    <form action="" method="POST">

        <div class="form-group">
            <!--<label>Votre mot de passe doit comporter les caractères suivant : lettres minuscules et majuscules, chiffres et caractères spéciaux.</label>-->
            <label>Votre mot de passe: </label>
            <input class="form-control" type="password" name="password" >
        </div>

        <div class="form-group">
            <label>Confirmation de votre nouveau mot de passe: </label>
            <input class="form-control" type="password" name="password-confirm">
        </div>

        <button class="btn btn-primary">Changer mon mot de passe</button>

    </form>

<?php require "../inc/footer.php" ?>
