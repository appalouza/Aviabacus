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

    $validator->ismActif($_POST['mActif'], "Veuillez spécifié si actif");

    $validator->isBours($_POST['bours'], "Veuillez spécifier si bousier");

    $validator->isMembre($_POST['lMembre'], "Veuillez spécifier votre niveau de membre");

    $validator->isAdmin('lMembre', "Veuillez saisir le niveau du membre");

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



     //requête pour enregistrer un utilisateurs
    if ($validator->isValid()) {

        //création d'un token random
        $token = Str::random(60);

        $requete = "INSERT INTO t_pilote 
            SET nom= ? , prenom = ?, codsexe = ?,adresse =?, codpost = ?, ville = ?, teldomicile = ?, telcellulaire = ?,
             email=?, profession=?, datnaissance=?, age=?, lieunaissance=?, nationalite=?, level_user=?,confirmation_token=?
                ";
        $donnees = array($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['adresse'], $_POST['codpost'], $_POST['ville'],
            $_POST['telperso'], $_POST['telcell'], $_POST['email'],
            $_POST['profession'], $_POST['datenaissance'], $_POST['age'], $_POST['lieunaissance'],
            $_POST['nationalite'], $_POST['lvl_user'], $token );




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

        $user_id = $db->lastInsertId();
        //insertion des données de qualification de vol d'un pilote sur un avion
        $requete2 = "INSERT INTO t_autorise SET id_pilote = ?, RR = ?, TI = ?, QZ = ?, PH = ? ";
        $donnees2 = array($user_id,$_POST['RR'],$_POST['TI'], $_POST['QZ'], $_POST['PH']);
        $db->query($requete2, $donnees2);

        //insertion des données de validité des licences
        $requete3 = "INSERT INTO t_licence SET id_pilote = ? ,datvaliditeppl=?, datfinvaliditeppl=?,
                datvaliditelicence=?, datfinvaliditelicence=?,
                datvaliditevisitemed=?,datfinvaliditevisitemed=?, 
                nom_medecin=?, restrictions_medicales=?";
        $donnees3 = array($user_id, $_POST['datvaliditeppl'],$_POST['datfinvaliditeppl'],
            $_POST['datvaliditelicence'], $_POST['datfinvaliditelicence'],
            $_POST['datvaliditevisitemed'], $_POST['datfinvaliditevisitemed'],
            $_POST['nom_medecin'], $_POST['restrictions_medicales']);
        $db->query($requete3, $donnees3);

        //insertion des données concernant l'aéroclub
        $requete4 = "INSERT INTO t_aeroclub SET id_pilote = ?, dateEntree = ?, dateCotis = ?, dateFinCotis = ?,
                mActif = ?, bours = ?, lMembre = ?";
        $donnees4 = array($user_id, $_POST['dateEntree'], $_POST['dateCotis'], $_POST['dateFinCotis'],
            $_POST['mActif'], $_POST['bours'], $_POST['lMembre']);
        $db->query($requete4, $donnees4);

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
                        <h2>Licence - Visite médicale</h2>
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