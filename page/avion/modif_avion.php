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
    $nb_donnee = 0;
  //  print_r($_POST);
    /*Test du nouveau nom, si le test est concluant, la requête SQL est modifiée pour mettre à jour le nouveau nom,
    sinon, les données ne sont pas ajoutées au tableau de données */
    if ($_POST['optradio'] != null) {
        $nb_donnee++;
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
        $nb_donnee++;
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
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('codeassoc', "Veuillez entrer un code assoc valide");
        if ($validator->isValid()) {
            $requete2 .= 'codassoc = ?';
            $donnees[] = $_POST['codeassoc'];

        }
    }
    if ($_POST['typeavion'] != null) {
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('typeavion', "Ce type d'avion n'est pas valide");
        if ($validator->isValid()) {
            $requete2 .= 'typeavion = ?';
            $donnees[] = $_POST['typeavion'];

        }
    }
    if ($_POST['marque'] != null) {
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('marque', 'Veuillez entrer une marque valide');
        if ($validator->isValid()) {
            $requete2 .= 'marque = ?';
            $donnees[] = $_POST['marque'];

        }
    }
    if ($_POST['puissance'] != null) {
        $nb_donnee++;
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
        $nb_donnee++;
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
        $nb_donnee++;
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
        print_r($_POST['observations']);
        echo "test";
        die();
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('observations', "Votre commentaire n'est pas valide");
        if ($validator->isValid()) {
            $requete2 .= 'observations = ?';
            $donnees[] = $_POST['observations'];

        }
    }
    if ($_POST['codeavion'] != null) {
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }

        $validator->isAlphanumeric('codeavion', "Votre code avion n'est pas valide");
        if ($validator->isValid()) {
            $requete2 .= 'codavion = ?';
            $donnees[] = $_POST['codeavion'];

        }
    }

/*Test de la taille du tableau donnee qui contient toutes les données pour la requête SQL et du nombre de données qui doivent être
    récoltées, si un validator renvoi une erreur, l'égalité sera fausse

Les requêtes SQL sont constituées de plusieurs parties:
- l'entête, qui contiens l'objectif de la requête
- les champs à modifiés, qui sont ajoutées lorsqu'un champ est effectivement modifié,
- la fin, qui permet de selectionner l'id de l'avion à modifier*/
    if (sizeof($donnees) == $nb_donnee) {

        $requete .= $requete2;
        $requete .= 'WHERE id = ?';
        $donnees[] = $id;

        $db->query($requete, $donnees);
        $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
        unset($_POST);

        //header('Location : ../../page/avion/Liste_Avion.php');
    }else{
        $errors = $validator->getErrors();

        unset($_POST);
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