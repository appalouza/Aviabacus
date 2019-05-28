<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";

require '../../inc/db.php';
logged_admin();



//vérification si des données ont été postées ou non, on passe en mode traitement
if (!empty($_POST)) {

    $db = App::getDatabase();
    //création d'une méthode de detection d'erreurs utilisant un tableau
    $errors = array();

    //connexion à la bdd grâce à la classe App


    $validator = new Validator($_POST);

        $validator->isAlpha('prenom', "Votre prénom n'est pas valide (alphanumérique)");

        $validator->isAlpha('nom', "Votre nom n'est pas valide (alphanumérique)");

        $validator->isSexe($_POST['sexe'], 'Veuillez renseigner votre sexe');

        $validator->isEmail('email', "Votre email n'est pas valide ");

        if ($validator->isValid()) {

            $validator->isUniq('email', $db, "Cet email est déjà pris");
        }

        $validator->isNumeric('codpost', "Votre code postal est invalide");
        if ($validator->isValid()) {
            $validator->isLen('codpost', "Votre Code postal n'est pas du bon format");
        }

        $validator->isNumeric('telcell', "Veuillez saisir un numéro de téléphone portable valide");

        $validator->isNumeric('telperso', "Veuillez saisir un numéro de téléphone perso valide");
        if ($_POST['telpro'] != null) {
            $validator->isNumeric('telpro', "Veuillez saisir un numéro de téléphone pro valide");
        }

        $validator->isNumeric('age', "Veuillez saisir un age valide");

        $validator->isAlpha('lieunaissance', "Veuillez saisir une ville de naissance");

        $validator->isLevel('lvl_user', "Veuillez choisir un niveau d'utilisateur");

        $validator-> isAlpha('nom_medecin', "Veuillez saisir le nom du médecin");

        $validator->isAlpha('restrictions_medicales', "Veuillez rentrer des restrictions valables");

        if ($_POST["userFirstContactName"] != null) {
            $validator->isAlpha('userFirstContactName', "Le nom du premier contact est invalide");
            $validator->isNumeric('userFirstContactPhone', "Le téléphone du premier contact est invalide");
        }

        if ($_POST["userSecondContactName"] != null) {
            $validator->isAlpha('userSecondContactName', "Le nom du Second contact est invalide");
            $validator->isNumeric('userSecondContactPhone', "Le téléphone du second contact est invalide");
        }
        if ($_POST['observations'] != null) {
            $validator->isAlphanumeric('observations', 'Les observations sont invalides');
        }



    $requete3 = 'UPDATE t_pilote SET ';
    $requete2 = "";
    $donnees2 = array();

    foreach ($_POST['a'] as $option){
        if ($option == "ltdp"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "RRatdp = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "aloc"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "RRaloc = ?";
            $donnees[] = 1;
        }
        elseif ($option == "anav"){
            if ($requete2 != null) {
                $requeteé .= ',';
            }
            $requete2 .= "RRanav = ?";
            $donnees2[] = 1;
        }
    }
    foreach ($_POST['b'] as $option){
        if ($option == "ltdp"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "TIatdp = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "aloc"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "TIaloc = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "anav"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "TIanav = ?";
            $donnees2[] = 1;
        }
    }
    foreach ($_POST['c'] as $option){
        if ($option == "ltdp"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "QZatdp = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "aloc"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "QZaloc = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "anav"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "QZanav = ?";
            $donnees2[] = 1;
        }
    }
    foreach ($_POST['d'] as $option){
        if ($option == "ltdp"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "PHatdp = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "PHoc"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "PHaloc = ?";
            $donnees2[] = 1;
        }
        elseif ($option == "anav"){
            if ($requete2 != null) {
                $requete2 .= ',';
            }
            $requete2 .= "PHanav = ?";
            $donnees2[] = 1;
        }
    }

    print_r($_POST['a']);
    print_r($donnees2);
    print_r($requete2);


    /* if ($_POST['nationalite']=='FR'){
         $validator->isMobilePhone('userFirstcontactPhone',"Le numéro de portable du premier contact n'est pas bon." );
         $validator->isMobilePhone('telcell', "Veuillez saisir un numéro de téléphone portable valide");

         $validator->isPhone('telperso', "Veuillez saisir un numéro de téléphone perso valide");

         $validator->isPhone('telpro', "Veuillez saisir un numéro de téléphone pro valide");
     }elseif ($_POST['nationalite'] == 'BEL'){

     }*/


    //requête pour enregistrer un utilisateurs
   if ($validator->isValid()) {

        //création d'un token random
        $token = Str::random(60);

        $requete = "INSERT INTO t_pilote 
            SET nom= ? , prenom = ?, codsexe = ?,adresse =?, codpost = ?, ville = ?, teldomicile = ?, telcellulaire = ?,
             email=?, profession=?, datnaissance=?, age=?, lieunaissance=?, nationalite=?, level_user=?,confirmation_token=?,datvaliditeppl=?, datfinvaliditeppl=?,
                datvaliditelicence=?, datfinvaliditelicence=?,
                datvaliditevisitemed=?,datfinvaliditevisitemed=?, nom_medecin=?, restrictions_medicales=?";
        $donnees = array($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['adresse'], $_POST['codpost'], $_POST['ville'], $_POST['telperso'], $_POST['telcell'], $_POST['email'],
            $_POST['profession'], $_POST['datenaissance'], $_POST['age'], $_POST['lieunaissance'],
            $_POST['nationalite'], $_POST['lvl_user'], $token,$_POST['datvaliditeppl'],$_POST['datfinvaliditeppl'],
            $_POST['datvaliditelicence'], $_POST['datfinvaliditelicence'],
            $_POST['datvaliditevisitemed'], $_POST['datfinvaliditevisitemed'],
            $_POST['nom_medecin'], $_POST['restrictions_medicales']);



        if ($_POST["userFirstContactName"] != null) {
            $requete .= ",userFirstContactName=?, userFirstContactPhone=?";
            $donnees[] = $_POST['userFirstContactName'];
            $donnees[] = $_POST['userFirstContactPhone'];
        }

        if ($_POST["userSecondContactName"] != null) {
            $requete .= ",userSecondContactName=?, userSecondContactPhone =?";
            $donnees[] = $_POST['userSecondContactName'];
            $donnees[] = $_POST['userSecondContactPhone'];
        }
        if ($_POST["observations"] != null){
            $requete .= ',Observations=?';
            $donnees[] = $_POST['observations'];
        }

        $db->query($requete, $donnees);

        $requetef="";
        $user_id = $db->lastInsertId();
        $requetef .= $requete3;
        $requetef .= $requete2;
        $requetef .= 'WHERE id = ?';
        $donnees2[] = $user_id;
        print_r($requetef);
        print_r($donnees2);

       $db->query($requetef, $donnees2);
        envoie_mail($user_id, $token);
        $_SESSION['flash']['success'] = "Un email de confirmation a été envoyé à l'utilisateur pour valider son compte";
        //redirection vers la page login.php
        header('Location: Inscription_Menu.php');
        exit();
    } else {
        $errors = $validator->getErrors();

    }
}


require "../../inc/GestionMenu.php"
?>
    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>-->

    <script type="text/javascript" src="../../js/cp_auto.js"></script>
    <script type="text/javascript" src="../../js/calcullAge.js"></script>
    <script type="text/javascript" src="../../js/jquery.smartWizard.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <link href="../../css/smart_wizard.css" rel="stylesheet">
    <h1>Inscription d'un nouveau pilote</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas remplis le formulaire correctement </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>
<form action="" method="post">


    <div class="container">

        <!-- SmartWizard 2 html -->
        <div id="smartwizard2">
            <ul>
                <li><a href="#step-1">Etape 1<br /><small>Coordonnées</small></a></li>
                <li><a href="#step-2">Etape 2<br /><small>Aéroclub</small></a></li>
                <li><a href="#step-3">Etape 3<br /><small>Licence - Visite Médicale</small></a></li>
            </ul>

            <div>
                <div id="step-1" class="">
                    <h2>Inscription des coordonnées</h2>
                    <?php require "../../page/inscription_user/CoordonnéesInscription.php" ?>
                </div>
                <div id="step-2" class="">
                    <h2>Inscription Aéroclub</h2>
                    <?php require "../../page/inscription_user/AéroclubInscription.php" ?>
                </div>
                <div id="step-3" class="">
                    <h2>Licence - <strong>Visite médicale</strong></h2>
                    <?php require "../../page/inscription_user/LicenceInscription.php" ?>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

            </div>

        </div>

    </div>

</form>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="../../js/jquery.smartWizard.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                //alert("You are on step "+stepNumber+" now");
                if(stepPosition === 'first'){
                    $("#prev-btn").addClass('disabled');
                }else if(stepPosition === 'final'){
                    $("#next-btn").addClass('disabled');
                }else{
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                .addClass('btn btn-info')
                .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                .addClass('btn btn-danger')
                .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Please note enabling option "showStepURLhash" will make navigation conflict for multiple wizard in a page.
            // so that option is disabling => showStepURLhash: false

            // Smart Wizard 2
            $('#smartwizard2').smartWizard({
                selected: 0,
                theme: 'default',
                transitionEffect:'fade',
                showStepURLhash: false
            });

        });
    </script>


<?php require "../../inc/footerInscription.php"?>