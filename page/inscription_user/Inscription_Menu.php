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
             email=?, profession=?, datnaissance=?, age=?, lieunaissance=?, nationalite=?, level_user=?,confirmation_token=?";
        $donnees = array($_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['adresse'], $_POST['codpost'], $_POST['ville'], $_POST['telperso'], $_POST['telcell'], $_POST['email'],
            $_POST['profession'], $_POST['datenaissance'], $_POST['age'], $_POST['lieunaissance'],
            $_POST['nationalite'], $_POST['lvl_user'], $token);



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
        print_r($_POST["observations"]);
        print_r($donnees);
        print_r($requete);

        $db->query($requete, $donnees);
        $user_id = $db->lastInsertId();
        envoie_mail($user_id, $token);
        $_SESSION['flash']['success'] = "Un email de confirmation a été envoyé à l'utilisateur pour valider son compte";
        //redirection vers la page login.php
        header('Location: Inscription_coordonnées.php');
        exit();
    } else {
        $errors = $validator->getErrors();

    }
}

require "../../inc/GestionMenu.php"
?>
    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>-->
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
    <script type="text/javascript" src="../../js/cp_auto.js"></script>
    <script type="text/javascript" src="../../js/calcullAge.js"></script>
    <script type="text/javascript" src="../../js/jquery.smartWizard.js"></script>


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
    <div class="container">

        <!-- SmartWizard 2 html -->
        <div id="smartwizard2">
            <ul>
                <li><a href="#step-1">Step 1<br /><small>This is step description</small></a></li>
                <li><a href="#step-2">Etape 2<br /><small>Inscription Aéroclub</small></a></li>
                <li><a href="#step-3">Step 3<br /><small>This is step description</small></a></li>
                <li><a href="#step-4">Step 4<br /><small>This is step description</small></a></li>
            </ul>

            <div>
                <div id="step-1" class="">
                    <h2>Step 1 Content</h2>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div id="step-2" class="">
                    <h2>Inscription Aéroclub</h2>
                    <?php require "../../page/inscription_user/Inscription_aéroclub.php"?>
                </div>
                <div id="step-3" class="">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div id="step-4" class="">
                    <h2>Step 4 Content</h2>
                    <div class="card">
                        <div class="card-header">My Details</div>
                        <div class="card-block p-0">
                            <table class="table">
                                <tbody>
                                <tr> <th>Name:</th> <td>Tim Smith</td> </tr>
                                <tr> <th>Email:</th> <td>example@example.com</td> </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

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

            // Smart Wizard 1
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                transitionEffect:'fade',
                showStepURLhash: false,
                toolbarSettings: {toolbarPosition: 'both',
                    toolbarExtraButtons: [btnFinish, btnCancel]
                }
            });

            // Smart Wizard 2
            $('#smartwizard2').smartWizard({
                selected: 0,
                theme: 'default',
                transitionEffect:'fade',
                showStepURLhash: false
            });

        });
    </script>
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
                <select class="form-control" name = "sexe" required>
                    <option value="2">Select...</option>
                    <option value=1>Mme.</option>
                    <option value=0>M.</option>
                </select>
            </div>
            <div class="form-group col-md-4" >
                <label >Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label >Prénom</label>
                <input type="text" name="prenom" class="form-control" required >
            </div>
        </div>

        <div class="form-group">
            <label >Email</label>
            <input type="text" name="email" class="form-control"  required>
        </div>

        <div class="form-group">
            <p><label for="">Niveau</label></p>
            <select name="lvl_user" class="form-control col-md-4" size="1" required>
                <option>Select...</option>
                <option>Pilote</option>
                <option>Chef-Pilote</option>
                <option>Trésorier</option>
                <option>Bureau</option>
                <option>Administrateur</option>
            </select>

        </div>



        <div class="form-row">
            <div class="form-group col-md-4">



                <label>Nationalité</label>
                <!--   <select name="pays" class="form-control col-md-5">
                    <option>Select...</option>
                    <?php
                //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
                /*$dbi->set_charset("utf8");
                $requete = 'SELECT * FROM pays';
                $resultat = $dbi->query($requete);
                while ($ligne = $resultat->fetch_assoc()) {
                    echo '<option>'.$ligne['nom_fr_fr'].' </option>';

                }
                $dbi->close();*/
                ?>
                </select>-->
                <input type="text" id="nationalite" name="nationalite" class="form-control" required>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" required>
            </div>


            <div class="form-group col-md-3">
                <label >Code postal</label>
                <input type="text" id="cp" size="6" name="codpost" class="form-control" required>

            </div>

            <div class="form-group col-md-3">
                <label>Ville</label>
                <input type="text" id="ville" name="ville" class="form-control"required/>

            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Téléphone portable</label>
                <input type="tel" name="telcell" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone domicile </label>
                <input type="tel" name="telperso" class="form-control" >
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone professionnel</label>
                <input type="tel" name="telpro" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Profession</label>
                <input type="text" name="profession" class="form-control" required>
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Date de naissance</label>
                <input type="date" name="datenaissance" id="DateNais" class="form-control" required Onblur="CalculAge()">
            </div>
            <div class="form-group col-md-4">
                <label>Age</label>
                <input type="number" name="age" id = "Age" class="form-control"required>
            </div>
            <div class="form-group col-md-4">
                <label>Lieu de naissance</label>
                <input type="text" name="lieunaissance" class="form-control" required>
            </div>

        </div>

        <h3>Personnes à contacter en cas d'accident</h3>
        <h4>1er contact</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Nom</label>
                <input type="text" name="userFirstContactName" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone</label>
                <input type="tel" name="userFirstContactPhone" class="form-control">
            </div>
        </div>

        <h4>2nd contact</h4>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Nom</label>
                <input type="text" name="userSecondContactName" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Téléphone</label>
                <input type="tel" name="userSecondContactPhone" class="form-control">
            </div>

        </div>
        <div class="form-group">
            <label>Observations</label>
            <textarea name="observations" id="comment" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>


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


<?php require "../../inc/footerInscription.php"?>