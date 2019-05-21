
<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

if (!empty($_POST)){

    if ($_POST['supp'] == 0){

        $db = App::getDatabase();
        $user_sup = $_SESSION['modif']->nom;
        $db->query('DELETE FROM t_pilote WHERE nom = ?', [$user_sup]);
        $_SESSION['flash']['success']="L'utilisateur à bien été supprimé";
        header('Location: Liste_User.php');
        exit();

    }elseif ($_POST['supp']==1){
        $_SESSION['flash']['danger']='La suppression a été annulée';
        header('Location: Liste_User.php');
        exit();
    }

}

require "../../inc/header_sous_dossier.php";
?>
<h1>Suppression d'un utilisateurs</h1>

<h2>Voulez-vous supprimer <?php echo $_SESSION['modif']->nom?> <?php echo $_SESSION['modif']->prenom;
    $user_id = $_SESSION['modif']->id;
    ?></h2>

<form action="" method="post">
    <button type="submit" name ="supp" class="btn btn-primary" value="0">Suppression</button>
    <button type="submit" name ="supp" class="btn btn-primary" value="1">Ne pas supprimer</button>
</form>


<?php require "../../inc/footer.php" ?>
