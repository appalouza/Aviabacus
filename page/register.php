

<?php 
//permet d'inclureautomatiquement des fichiers
require_once '../inc/bootstrap.php';

//vérification si des données ont été postées ou non, on passe en mode traitement
	if (!empty($_POST)) {

		//création d'une méthode de detection d'erreurs utilisant un tableau
		$errors = array();

		//connexion à la bdd grâce à la classe App
		$db = App::getDatabase();

		$validator = new Validator($_POST);

		$validator->isAlphanumeric('username', "Votre pseudo n'est pas valide (alphanumérique)");
		if ($validator->isValid()){

            $validator->isUniq('username', $db, "users", "Ce pseudo est déjà pris");

        }

        $validator->isAlphanumeric('userfirstname', "Votre prénom n'est pas valide (alphanumérique)");

        $validator->isAlphanumeric('userlastname', "Votre nom n'est pas valide (alphanumérique)");

        $validator->isEmail('email',"Votre email n'est pas valide ");

		if ($validator->isValid()){

            $validator->isUniq('email', $db, "users", "Cet email est déjà pris");
        }

        $validator->isLevel('lvl_user', "Veuillez choisir un niveau d'utilisateur");

        $validator->isPassword('password', "Ce mot de passe n'est pas valide");


		//requête pour enregistrer un utilisateurs
		if ($validator->isValid()) {

			$auth = new Auth($db);

			$auth->register($_POST['username'], $_POST['userfirstname'], $_POST['userlastname'], $_POST['password'], $_POST['email'], $_POST['lvl_user'],$db);

			Session::getInstance()->setFlash('success','Un email de confirmation vous a été envoyé pour valider votre compte' );

			//redirection vers la page login.php
			header('Location: ../page/login.php');
			exit();
		} else {
		    $errors = $validator->getErrors();
        }
		
		//permet de voir le contenu de la liste erreurs
		//debug($errors);

	}
	
require '../inc/header.php';

?>

<h3>Inscription d'un nouvel utilisateur</h3>

<?php if (!empty($errors)): ?>
	<div class="alert alert-danger">
		<p>Vous n'avez pas remplis le formulaire correctement </p>
		<?php foreach ($errors as $error): ?>
			<li><?=$error; ?> </li>
		<?php endforeach ?>
		
	</div>
<?php endif; ?>


<form action="" method="POST">
	
	<div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="username" class = "form-control" >

    </div>

    <div class="form-group">
        <label for="">Nom</label>
        <input type="text" name="userfirstname" class = "form-control" >

    </div>

    <div class="form-group">
        <label for="">Prénom</label>
        <input type="text" name="userlastname" class = "form-control" >

    </div>

	<div class="form-group">
		<label for="">Email</label>	
		<input type="text" name="email" class = "form-control" >

	</div>


	<div class="form-group">
		<p><label for="">Niveau</label></p>
		<select name="lvl_user" size="1">
			<option>Pilote</option>
			<option>Chef-Pilote</option>
			<option>Trésorier</option>
			<option>Bureau</option>
			<option>Administrateur</option>
		</select>

	</div>

	<div class="form-group">
		<label for="">Mot de passe</label>	
		<input type="password" name="password" class = "form-control" >

	</div>

	<div class="form-group">
		<label for="">Confirmation du mot de passe</label>
		<input type="password" name="password-confirm" class = "form-control" >

	</div>
	<button type="submit" class="=btn btn-primary">M'inscrire</button>


</form>

<?php require '../inc/footer.php'; ?>