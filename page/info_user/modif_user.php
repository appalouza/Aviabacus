<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

if (!empty($_POST)){
    $db = App::getDatabase();
    $validator = new Validator($_POST);
    $requete = 'UPDATE t_pilote SET ';
    $donnees = array();
    $errors = array();

    //Test du nouveau nom, si le test est concluant, la requête SQL est modifiée pour mettre à jour le nouveau nom
    if ($_POST['modifName']!=null){
        $validator->isAlphanumeric('modifName', "Ce nom n'est pas valable");
        if ($validator->isValid()){
            $requete .='nom = ?';
            $donnees[] = $_POST['modifName'];

        }
    }
    if ($_POST['modifPrenom']!=null){
        $validator->isAlphanumeric('modifPrenom', "Ce prenom n'est pas valable");
        if ($validator->isValid()){
            $requete .='prenom = ?';
            $donnees[] = $_POST['modifPrenom'];

        }
    }

    if ($_POST['modifEmail'] !=null){
        $validator->isEmail('modifEmail', "Cet email n'est pas valide");
        if ($validator->isValid()){
            $requete .='email = ?';
            $donnees[] = $_POST['modifEmail'];

        }
    }
    else{
        $_SESSION['flash']['danger'] = "Pas de modifs";
        $errors = $validator->getErrors();
    }

if ($donnees != null){
    $requete .= 'WHERE id = ?';
    $donnees[] = $_SESSION['modif']->id;
    print_r($donnees);
    print_r($requete);

    $db->query($requete, $donnees);
    $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
}


}
require "../../inc/header_sous_dossier.php";
?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas remplis le formulaire correctement </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>

<form method="post" action="">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Options</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="text" name="modifName" class="form-control" placeholder="<?php echo $_SESSION['modif']->nom?> "></td>

            <td><input type="text" name="modifPrenom" class="form-control" placeholder="<?php echo $_SESSION['modif']->prenom?>"></td>
            <td><input type="email" name="modifEmail" class="form-control" placeholder="<?php echo $_SESSION['modif']->email?>"></td>
            <td>
                <button type="submit" class="btn btn-primary">Validation des modifications</button>

            </td>
        </tr>
        </tbody>


    </table>

</form>


<?php require "../../inc/footer.php" ?>

