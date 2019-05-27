<?php

require "../../inc/functions.php";
require_once '../../inc/bootstrap.php';
logged_only();
$validator = new Validator($_POST);
$validator->isPassword('password_new', "Votre mot de passe est incorrect");
    if (!empty($_POST)){

        if ($validator->isValid()){
            if(password_verify($_POST['old_password'], $_SESSION['auth']->password)){

                $db = App::getDatabase();
                $user_id = $_SESSION['auth']->id;
                $password = password_hash($_POST['password_new'], PASSWORD_BCRYPT);
                $db->query("UPDATE t_pilote SET password = ? WHERE id = ?",[$password, $user_id]);
                $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis à jour";
                header('Location: accueil.php');

                exit();
            }
            else{
                $errors['password_new']= 'Veuillez renseigner votre ancien mot de passe';
            }
        }else{
            $errors = $validator->getErrors();
        }
    }/*else{
        $errors = $validator->getErrors();
    }*/

require "../../inc/header_sous_dossier.php"
?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas renseigné votre mot de passe correctement: </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>


<div class="container">

    <h4>Changer le mot de passe</h4>
    <h5>Il doit contenir au minimum: </h5>
    <ul>
        <li>Une lettre minuscule</li>
        <li>Une lettre majuscule</li>
        <li>Un chiffre</li>
        <li>Un caractère spécial (!@#$%^&*-)</li>
        <li>Entre 8 et 12 caractères</li>


    </ul>
    <form action="" method="POST">

        <div class="form-group">
            <label>Votre ancien mot de passe: </label>
            <input class="form-control" type="password" name="old_password">
        </div>

        <div class="form-group">
            <label>Votre nouveau mot de passe: </label>
            <input class="form-control" type="password" name="password_new" >
        </div>

        <div class="form-group">
            <label>Confirmation de votre nouveau mot de passe: </label>
            <input class="form-control" type="password" name="password_new_confirm">
        </div>

        <button class="btn btn-primary">Changer mon mot de passe</button>

    </form>
</div>
<?php //debug($_SESSION); ?>

<?php require "../../inc/footer.php" ?>