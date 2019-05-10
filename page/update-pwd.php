<?php

require "../inc/functions.php";
require_once '../inc/bootstrap.php';
logged_only();
/*$validator = new Validator($_POST);
$validator->isPassword2('password_new', "Votre mot de passe est incorrect");*/

    if (!empty($_POST) /*&& $validator->isValid()*/) {

        if(password_verify($_POST['old_password'], $_SESSION['auth']->password)){
            if (!empty($_POST['password_new']) && $_POST['password_new'] == $_POST['password_new_confirm']) {

                $db = App::getDatabase();
                $user_id = $_SESSION['auth']->id;
                $password = password_hash($_POST['password_new'], PASSWORD_BCRYPT);
                $db->query("UPDATE t_pilote SET password = ? WHERE id = ?",[$password, $user_id]);
                $_SESSION['flash']['success'] = "Votre mot de passe à bien été mis à jour";
                header('Location: accueil.php');

                exit();
            }else{

                $_SESSION['flash']['error'] = 'Les mots de passe ne correspondent pas';
        }}
        else{

            $_SESSION['flash']['error'] = 'Veuillez renseigner votre ancien mot de passe';
        }
        }

require "../inc/header.php"
?>



<div class="container">

    <h4>Changer le mot de passe</h4>
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

<?php require "../inc/footer.php" ?>