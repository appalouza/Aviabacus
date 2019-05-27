<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
$id = $_GET['id'];
$db = App::getDatabase();
$resultat = $db->query('SELECT * FROM t_pilote WHERE id =?', [$id])->fetch();
$pilote['modif'] = $resultat;

if (!empty($_POST)){

    $validator = new Validator($_POST);
    $requete = 'UPDATE t_pilote SET ';
    $donnees = array();
    $requete2 = "";
    $errors = array();
    $nb_donnee = 0;

    //Test du nouveau nom, si le test est concluant, la requête SQL est modifiée pour mettre à jour le nouveau nom
    if ($_POST['nom']!=null){
        $nb_donnee++;

        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('nom', "Ce nom n'est pas valable");

        if ($validator->isValid()){
            $requete2 .='nom = ?';
            $donnees[] = $_POST['nom'];

        }
    }
    if ($_POST['sexe']!=null  && $_POST['sexe'] != $pilote['modif']->codsexe){
        $nb_donnee++;

        if ($requete2 != null) {
            $requete2 .= ',';
        }
         $requete2 .='codsexe = ?';
            $donnees[] = $_POST['sexe'];


    }
    if ($_POST['prenom']!=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('prenom', "Ce prenom n'est pas valable");
        if ($validator->isValid()){
            $requete2 .='prenom = ?';
            $donnees[] = $_POST['prenom'];

        }
    }

    if ($_POST['email'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isEmail('email', "Cet email n'est pas valide");
        if ($validator->isValid()){
            $requete2 .='email = ?';
            $donnees[] = $_POST['email'];

        }
    }
    if ($_POST['lvl_user'] !=null && $_POST['lvl_user'] != $pilote['modif']->level_user){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }


            $requete2 .='level_user = ?';
            $donnees[] = $_POST['lvl_user'];


    }
    if ($_POST['nationalite'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('nationalite', 'Veuillez entrer une nationalité valide');
        if ($validator->isValid()){
            $requete2 .='nationalite = ?';
            $donnees[] = $_POST['nationalite'];

        }
    }
    if ($_POST['adresse'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlphanumeric('adresse', 'Veuillez entrer une adresse valide');
        if ($validator->isValid()){
            $requete2 .='adresse = ?';
            $donnees[] = $_POST['adresse'];

        }
    }
    if ($_POST['codpost'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isLen('codpost', 'Veuillez entrer un code postale valide');
        if ($validator->isValid()){
            $requete2 .='codpost = ?';
            $donnees[] = $_POST['codpost'];

        }
    }
    if ($_POST['ville'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('ville', 'Veuillez entrer une nationalité valide');
        if ($validator->isValid()){
            $requete2 .='ville = ?';
            $donnees[] = $_POST['ville'];

        }
    }
    if ($_POST['telcell'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('telcell', "Ce numéro de téléphone portable valide");
        if ($validator->isValid()){
            $requete2 .='telcellulaire = ?';
            $donnees[] = $_POST['telcell'];

        }
    }
    if ($_POST['teldom'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('teldom', "Ce numéro de téléphone domicile valide");
        if ($validator->isValid()){
            $requete2 .='teldomicile = ?';
            $donnees[] = $_POST['teldom'];

        }
    }
    if ($_POST['telpro'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('telpro', 'Veuillez entrer un téléphone pro valide');
        if ($validator->isValid()){
            $requete2 .='telpro = ?';
            $donnees[] = $_POST['telpro'];

        }
    }
    if ($_POST['profession'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('profession', 'Veuillez entrer une profession valide');
        if ($validator->isValid()){
            $requete2 .='profession = ?';
            $donnees[] = $_POST['profession'];

        }
    }
    if ($_POST['datenaissance'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
            $requete2 .='datnaissance = ?';
            $donnees[] = $_POST['datenaissance'];


    }
    if ($_POST['age'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('age', 'Veuillez entrer un age valide');
        if ($validator->isValid()){
            $requete2 .='age = ?';
            $donnees[] = $_POST['age'];

        }
    }
    if ($_POST['lieunaissance'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('lieunaissance', 'Veuillez entrer un lieu de naissance valide');
        if ($validator->isValid()){
            $requete2 .='lieunaissance = ?';
            $donnees[] = $_POST['lieunaissance'];

        }
    }
    if ($_POST['userFirstContactName'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('userFirstContactName', 'Veuillez entrer un nom de premier contact valide');
        if ($validator->isValid()){
            $requete2 .='userFirstContactName = ?';
            $donnees[] = $_POST['userFirstContactName'];

        }
    }
    if ($_POST['userFirstContactPhone'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('userFirstContactPhone', 'Veuillez entrer un téléphone de premier contact valide');
        if ($validator->isValid()){
            $requete2 .='userFirstContactPhone = ?';
            $donnees[] = $_POST['userFirstContactPhone'];

        }
    }
    if ($_POST['userSecondContactName'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('userSecondContactName', 'Veuillez entrer un nom de second contact valide');
        if ($validator->isValid()){
            $requete2 .='userSecondContactName = ?';
            $donnees[] = $_POST['userSecondContactName'];

        }
    }
    if ($_POST['userSecondContactPhone'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('userSecondContactPhone', 'Veuillez entrer un téléphone de second contact valide');
        if ($validator->isValid()){
            $requete2 .='userSecondContactPhone = ?';
            $donnees[] = $_POST['userSecondContactPhone'];

        }
    }

    if ($_POST['observations'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlphanumeric('observations', 'Veuillez entrer une observation valide');
        if ($validator->isValid()){
            $requete2 .='Observations = ?';
            $donnees[] = $_POST['observations'];

        }
    }



if (sizeof($donnees) == $nb_donnee){
    $requete .= $requete2;
    $requete .= 'WHERE id = ?';
    $donnees[] = $id;

    $db->query($requete, $donnees);
    $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
    unset($_POST);
    header('Location: Liste_User.php');
    exit();
} else{
    $errors = $validator->getErrors();
    unset($_POST);
}



}
require "../../inc/header_sous_dossier.php";
?>


    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
    <script type="text/javascript" src="../../js/cp_auto.js"></script>
    <script type="text/javascript" src="../../js/calcullAge.js"></script>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas remplis le formulaire correctement </p>
            <?php foreach ($errors as $error): ?>
                <li><?=$error; ?> </li>
            <?php endforeach ?>

        </div>
    <?php endif; ?>
<h1>Modification du pilote <?php echo $pilote['modif']->prenom?> <?php echo $pilote['modif']->nom?></h1>
    <form action="" method="POST">
        <!--	<div class="form-group">
                <picture>
                    <img src="img_orange_flowers.jpg" alt="Photo" style="width:auto;">
                </picture>
                <input type="file" name="userProfilPicture" class="form-control">
            </div>-->
        <h2>Coordonnées</h2>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Sexe</label>
                <select class="form-control" name = "sexe">
                    <option value="2">Select...</option>
                    <option <?php if($pilote['modif']->codsexe == 1 ){echo 'selected=\'selected\'';}?> value=1>Mme.</option>
                    <option <?php if($pilote['modif']->codsexe == 0 ){echo 'selected=\'selected\'';}?> value=0>M.</option>
                </select>
            </div>
            <div class="form-group col-md-4" >
                <label >Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="<?php echo $pilote['modif']->nom?>">
            </div>
            <div class="form-group col-md-4">
                <label >Prénom</label>
                <input type="text" name="prenom" class="form-control"  placeholder="<?php echo $pilote['modif']->prenom?>">
            </div>
        </div>

        <div class="form-group">
            <label >Email</label>
            <input type="text" name="email" class="form-control" placeholder="<?php echo $pilote['modif']->email?>" >
        </div>

        <div class="form-group">
            <label for="">Niveau</label>
            <select name="lvl_user" class="form-control col-md-4" size="1" required >
                <option >Select...</option>
                <option <?php if($pilote['modif']->level_user == 'Pilote' ){echo 'selected=\'selected\'';}?>>Pilote</option>
                <option <?php if($pilote['modif']->level_user == 'Chef-Pilote' ){echo 'selected=\'selected\'';}?>>Chef-Pilote</option>
                <option <?php if($pilote['modif']->level_user == 'Trésorier' ){echo 'selected=\'selected\'';}?>>Trésorier</option>
                <option <?php if($pilote['modif']->level_user == 'Bureau' ){echo 'selected=\'selected\'';}?>>Bureau</option>
                <option <?php if($pilote['modif']->level_user == 'Administrateur' ){echo 'selected=\'selected\'';}?>>Administrateur</option>
            </select>

        </div>



        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Nationalité</label>
                <!--<select name="pays" class="form-control col-md-5">
                    <option>Select...</option>
                    <?php
                    /*$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
                    $dbi->set_charset("utf8");
                    $requete = 'SELECT * FROM pays';
                    $resultat = $dbi->query($requete);
                    while ($ligne = $resultat->fetch_assoc()) {
                        echo '<option>'.$ligne['nom_fr_fr'].' </option>';

                    }
                    $dbi->close();*/
                    ?>
                </select>-->
                <input type="text" id="nationalite" name="nationalite" class="form-control" placeholder="<?php echo $pilote['modif']->nationalite?>">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" placeholder="<?php echo $pilote['modif']->adresse?>">
            </div>


            <div class="form-group col-md-3">
                <label >Code postal</label>
                <input type="text" id="cp" size="6" name="codpost" class="form-control" placeholder="<?php echo $pilote['modif']->codpost?>">

            </div>

            <div class="form-group col-md-3">
                <label>Ville</label>
                <input type="text" id="ville" name="ville" class="form-control" placeholder="<?php echo $pilote['modif']->ville?>">

            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Téléphone portable</label>
                <input type="tel" name="telcell" class="form-control" placeholder=" <?php echo $pilote['modif']->telcellulaire?>">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone domicile </label>
                <input type="tel" name="teldom" class="form-control" placeholder=" <?php echo $pilote['modif']->teldomicile?>">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone professionnel</label>
                <input type="tel" name="telpro" class="form-control"  placeholder=" <?php echo $pilote['modif']->telpro?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Profession</label>
                <input type="text" name="profession" class="form-control" placeholder=" <?php echo $pilote['modif']->profession?>">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Date de naissance</label>
                <input type="date" name="datenaissance" id="DateNais" Onblur="CalculAge()" class="form-control" placeholder="<?php echo $pilote['modif']->datnaissance?>">
            </div>
            <div class="form-group col-md-4">
                <label>Age</label>
                <input type="number" name="age" id = "Age" class="form-control" placeholder="<?php echo $pilote['modif']->age?>">
            </div>
            <div class="form-group col-md-4">
                <label>Lieu de naissance</label>
                <input type="text" name="lieunaissance" class="form-control" placeholder="<?php echo $pilote['modif']->lieunaissance?>" >
            </div>

        </div>



        <h3>Personnes à contacter en cas d'accident</h3>
        <h4>1er contact</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Nom</label>
                <input type="text" name="userFirstContactName" class="form-control" placeholder="<?php echo $pilote['modif']->userFirstContactName;?>">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone</label>
                <input type="tel" name="userFirstContactPhone" class="form-control" placeholder="<?php echo $pilote['modif']->userFirstContactPhone;?>">
            </div>
        </div>

        <h4>2nd contact</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Nom</label>
                <input type="text" name="userSecondContactName" class="form-control" placeholder="<?php echo $pilote['modif']->userSecondContactName;?>">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone</label>
                <input type="tel" name="userSecondContactPhone" class="form-control" placeholder="<?php echo $pilote['modif']->userSecondContactPhone;?>">
            </div>

        </div>
        <div class="form-group">
            <label>Observations</label>
            <textarea name = "observations" class="form-control" rows="3" placeholder="<?php echo $pilote['modif']->Observations;?>"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="Liste_User.php" class="btn btn-primary">Retour à la liste</a>


    </form>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="Inscription_coordonnées.php">1</a></li>
            <li class="page-item"><a class="page-link" href="Inscription_aéroclub.php">2</a></li>
            <li class="page-item"><a class="page-link" href="Inscription_licence.php">3</a></li>
            <li class="page-item">
                <a class="page-link" href="Inscription_aéroclub.php">Next</a>
            </li>
        </ul>
    </nav>





<?php require "../../inc/footer.php" ?>

