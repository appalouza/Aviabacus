

<?php 
//permet d'inclureautomatiquement des fichiers
require_once '../inc/bootstrap.php';

//vérification si des données ont été postées ou non, on passe en mode traitement
	if (!empty($_POST)) {

		//création d'une méthode de detection d'erreurs utilisant un tableau
		$errors = array();

		//connexion à la bdd grâce à la classe App
		$db = App::getDatabase();

		/*$validator = new Validator($_POST);

		$validator->alphanumeric('username', "Votre pseudo n'est pas valide (alphanumérique)");

		var_dump($validator);
		die();*/

		session_start();

		if (empty($_POST['username']) || !preg_match('/^[A-Za-z0-9]+$/', $_POST['username'])) {
			
			//ajout d'un message d'erreur dans la liste $errors
			$errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
		}
		else{

			//envoie et reception de la requête
			$user = $db->query('SELECT id FROM users WHERE username = ?',[$_POST['username']])->fetch();

			if ($user) {
				
				$errors['username']="Ce pseudo est déjà pris";
			}
			
		}

		if(empty($_POST['lvl_user'])){

			$errors['lvl_user'] = "Veuillez choisir un niveau d'utilisateur";
		}

		if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	
			$errors['email'] = "Votre email n'est pas valide";
		}
		else{

			$user = $db->query('SELECT id FROM users WHERE email = ?', [$_POST['email']]) ->fetch();
			
			if ($user) {
				# code...
				$errors['email']="Cet email est déjà pris";
			}

		}

		if (empty($_POST['password']) || $_POST['password'] != $_POST['password-confirm']){

			$errors['password'] = "Votre mot de passe n'est pas valide!";
		}

		//requête pour enregistrer un utilisateurs
		if (empty($errors)) {

			//hash du mot de passe renseigné
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			//création d'un token random
			$token = str_random(60);

			$req = $db->query("INSERT INTO users SET username= ?, email = ?, password = ?, confirmation_token=?, lvl_user=?",[
				$_POST['username'], 
				$_POST['email'],
				$password, 
				$token, 
				$_POST['lvl_user']]) ->fetch();

			//récupération de l'id de l'user
			$user_id = $db->lastInsertId();

			//envoie d'un mail de confirmation
			mail($_POST['email'], "confrimation de votre compte", 'Afin de valider votre compte, veuillez cliquer sur ce lien : \n\n
				http://localhost/log_utilisateurs/page/confirm.php?id=$user_id&token=$token');

			//ajout d'un message flash de succès dans la variable SESSION
			$_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';

			//redirection vers la page login.php
			header('Location: login.php');
			exit();
		}
		
		//permet de voir le contenu de la liste erreurs
		//debug($errors);

	}
	
require '../inc/header.php';

?>

<h1>Inscription d'un nouvel utilisateur</h1>

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
		<label for="">Confirmation</label>	
		<input type="password" name="password-confirm" class = "form-control" >

	</div>
	<button type="submit" class="=btn btn-primary">M'inscrire</button>


</form>

<?php require '../inc/footer.php'; ?>