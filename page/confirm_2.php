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

if($user->confirmation_token == null){
    $_SESSION['flash']['error'] = "Ce token n'est plus valide";
    header('Location: ../page/login.php');
}

if (!empty($_POST)){
    if($validator->isValid() && $user && $user->confirmation_token == $token ){

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $db->query('UPDATE t_pilote SET confirmation_token = NULL, password =?, confirmed_at = NOW() WHERE id = ?',[$password,$user_id] );
        $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
        $_SESSION['auth'] = $user;
        header('Location: ../page/login.php');
    }else{
        $errors = $validator->getErrors();

    }
}

require "../inc/header.php"
?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas renseigné votre mot de passe correctement: </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>


    <h4>Veuillez choisir votre mot de passe:</h4>
<h5>Il doit contenir au minimum: </h5>
<ul>
    <li>Une lettre minuscule</li>
    <li>Une lettre majuscule</li>
    <li>Une chiffre</li>
    <li>Un caractère spécial (!@#$%^&*-)</li>
    <li>Entre 8 et 12 caractères</li>


</ul>
    <form action="" method="POST">

        <div class="form-group">
            <!--<label>Votre mot de passe doit comporter les caractères suivant : lettres minuscules et majuscules, chiffres et caractères spéciaux.</label>-->
            <label>Votre mot de passe: </label>
            <input class="form-control" type="password" name="password" >
        </div>

        <div class="form-group">
            <label>Confirmation de votre nouveau mot de passe: </label>
            <input class="form-control" type="password" name="password_confirm">
        </div>

        <button class="btn btn-primary">Changer mon mot de passe</button>

    </form>

<?php require "../inc/footer.php" ?>
