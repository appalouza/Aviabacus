
<?php require "../inc/header.php" ?>

<?php
	if (isset($_GET['id']) && isset($_GET['token'])) {
		# code...
		require '../bdd/db.php';
		require '../inc/functions.php';

		$req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at >DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
		$req->execute([$_GET['id'], $_GET['token']]);

		$user = $req->fetch();

		if ($user) {
			# code...
			debug($user);

			if (!empty($_POST)) {
				# code...
				if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
					# code...
					$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
					$pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL') -> execute([$password]);

					session_start();
					$_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";
					$_SESSION['auth'] = $user;
					header('Location: account.php');
					exit();
				}
			}
			
		}else{
			session_start();
			$_SESSION['flash']['error'] = "Ce token n'est pas valide";
		}
	}
	else{
		header('Location: ../page/login.php');
	}


?>
<h1>Réinitialisation du mot de passe</h1>

	<form action="" method="POST">

	<div class="form-group">
		<label for="">Mot de passe</label>	
		<input type="password" name="password" class = "form-control" >

	</div>

	<div class="form-group">
		<label for="">Confirmation du mot de passe</label>	
		<input type="text" name="password_confirm" class = "form-control" >

	</div>

	<button type="submit" class="=btn btn-primary">Réinitialiser mon mot de passe</button>


	</form>

<?php require "../inc/footer.php" ?>