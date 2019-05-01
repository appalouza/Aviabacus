<?php 
session_start();
require "../inc/functions.php";
logged_only();

if (!empty($_POST)) {
	# code...
	if (!empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
		# code...
		$_SESSION['flash']['danger'] = 'Les mots de passes ne correspondent pas';
	}else{
		$user_id = $_SESSION['auth']->$id;

		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		require_once '../bdd/bd.php';

		$req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?') -> execute([$password, $user_id]);

		$_SESSION['flash']['success'] = 'Votre mot de passe a bein été mis à jour';
	}
}
require "../inc/header.php"
?>

	<h3>Veuillez entre votre nouveau mot de passe <?= $_SESSION['auth']->username; ?></h3>


	<form action="" method="POST">
		
		<div class="form-group">
			<input class="form-control" type="password" name="password" placeholder="Changer de mot de passe">
		</div>	

		<div class="form-group">
			<input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
		</div>	

		<button class="btn btn-primary">Changer mon mot de passe</button>

	</form>

<?php debug($_SESSION); ?>

<?php require "../inc/footer.php" ?>