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
            <li class="page-item"><a class="page-link" href="AéroclubInscription.php">2</a></li>
            <li class="page-item"><a class="page-link" href="Inscription_licence.php">3</a></li>
            <li class="page-item">
                <a class="page-link" href="AéroclubInscription.php">Next</a>
            </li>
        </ul>
    </nav>


<?php require "../../inc/footerInscription.php"?>