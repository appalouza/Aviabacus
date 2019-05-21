<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
$id = $_GET['id'];
$db = App::getDatabase();
$resultat = $db->query('SELECT * FROM t_avion WHERE id =?', [$id])->fetch();
$avion['modif'] = $resultat;

if (!empty($_POST)) {

    $validator = new Validator($_POST);
    $requete = 'UPDATE t_avion SET ';
    $requete2 = "";
    $donnees = array();
    $errors = array();

    //Test du nouveau nom, si le test est concluant, la requête SQL est modifiée pour mettre à jour le nouveau nom
    if ($_POST['optradio'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        //$validator->isAlphanumeric('modifName', "Ce nom n'est pas valable");
        if ($validator->isValid()) {
            $requete2 .= 'en_flotte = ?';
            $donnees[] = $_POST['optradio'];

        }
    }
    if ($_POST['codavioabrege'] != null) {

        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('codavioabrege', "Veuillez entrer un code avion valide");
        if ($validator->isValid()) {
            $requete2 .= 'codavioabrege = ?';
            $donnees[] = $_POST['codavioabrege'];

        }
    }

    if ($_POST['codeassoc'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('codeassoc', "Veuillez entrer un code assoc valide");
        if ($validator->isValid()) {
            $requete2 .= 'codeassoc = ?';
            $donnees[] = $_POST['codeassoc'];

        }
    }
    if ($_POST['typeavion'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        //$validator->isEmail('modifEmail', "Cet email n'est pas valide");
        if ($validator->isValid()) {
            $requete2 .= 'typeavion = ?';
            $donnees[] = $_POST['typeavion'];

        }
    }
    if ($_POST['marque'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlpha('marque', 'Veuillez entrer une marque valide');
        if ($validator->isValid()) {
            $requete2 .= 'marque = ?';
            $donnees[] = $_POST['marque'];

        }
    }
    if ($_POST['puissance'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isNumeric('puissance', 'Veuillez entrer une puissance valide');
        if ($validator->isValid()) {
            $requete2 .= 'puissance = ?';
            $donnees[] = $_POST['puissance'];

        }
    }
    if ($_POST['vitesse'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isNumeric('vitesse', 'Veuillez entrer une vitesse valide');
        if ($validator->isValid()) {
            $requete2 .= 'vitesse = ?';
            $donnees[] = $_POST['vitesse'];

        }
    }
    if ($_POST['consoreel'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isNumeric('consoreel', 'Veuillez entrer une consommation valide');
        if ($validator->isValid()) {
            $requete2 .= 'consoreel = ?';
            $donnees[] = $_POST['consoreel'];

        }
    }

    if ($_POST['observations'] != null) {
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlpha('observations', "Votre commentaire n'est pas valide");
        if ($validator->isValid()) {
            $requete2 .= 'observations = ?';
            $donnees[] = $_POST['observations'];

        }
    }


    $requete .= $requete2;
echo $requete;

    if ($donnees != null && $validator->isValid()) {
        $requete .= 'WHERE id = ?';
        $donnees[] = $id;

        $db->query($requete, $donnees);
        $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
        //header('Location : ../../page/avion/Liste_Avion.php');
    }else{
        $errors = $validator->getErrors();
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
<h1>Modification d'un avion:</h1>

    <form action="" method="POST">

        <h2>Coordonnées</h2>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Code abrégé</label>
                <input type="text" name="codavioabrege" class="form-control" placeholder="<?php echo $avion['modif']->codavioabrege?>">
            </div>
            <div class="form-group col-md-2" >
                <label >Code avion</label>
                <input type="text" name="codeavion" class="form-control" placeholder="<?php echo $avion['modif']->codavion?>" >
            </div>
            <div class="form-group col-md-2">
                <label >Code assoc</label>
                <input type="text" name="codeassoc" class="form-control" placeholder="<?php echo $avion['modif']->codassoc?>">
            </div>
            <div class="form-group col-md-2">
                <label >Type avion</label>
                <input type="text" name="typeavion" class="form-control" placeholder="<?php echo $avion['modif']->typeavion?>">
            </div>
            <div class="form-group col-md-2">
                <label >Marque</label>
                <input type="text" name="marque" class="form-control" placeholder="<?php echo $avion['modif']->marque?>">
            </div>


        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label >Puissance</label>
                <input type="text" name="puissance" class="form-control" placeholder="<?php echo $avion['modif']->puissance?>">
            </div>
            <div class="form-group col-md-2">
                <label >Vitesse</label>
                <input type="text" name="vitesse" class="form-control" placeholder="<?php echo $avion['modif']->vitesse?>">
            </div>
            <div class="form-group col-md-2">
                <label >Consommation réelle</label>
                <input type="text" name="consoreel" class="form-control" placeholder="<?php echo $avion['modif']->consoreel?>">
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label >Observations</label>
                <textarea rows="5" name="observations" id="comment" class="form-control" placeholder="<?php echo $avion['modif']->observations?>"></textarea>
            </div>
            <div class="custom-control custom-radio">
                <label >En flotte</label><br/>

                <label class="radio-inline"><input type="radio" value="1" name="optradio" <?php if($avion['modif']->en_flotte == 1){echo 'checked';} ?>>Oui</label>
                <label class="radio-inline"><input type="radio" value="0" name="optradio"<?php if($avion['modif']->en_flotte == 0){echo 'checked';} ?>>Non</label>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="save">Enregistrer les changements</button>
            <a href="Liste_Avion.php" class="btn btn-primary">Retour à la liste</a>
        </div>
    </form>


<?php require "../../inc/footer.php" ?>