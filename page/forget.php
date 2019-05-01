<?php require "../inc/functions.php" ?>

<?php require "../inc/header.php" ?>

<?php
	if (!empty($_POST) && !empty($_POST['email'])) {
		# code...
		require_once "../inc/header.php";
		require_once "../bdd/db.php";
		$req = $pdo->prepare('SELECT * FROM users WHERE email=? && confirmed_at IS NOT null');
		$req->execute([$_POST['email']]);
		$user = $req->fetch();
		//comparaison du mot de passe tapé et du mot de passe dans la BDD (celui stocké étant haché)
		if($user){
			$_SESSION['auth']=$user;
			$reset_token = str_random(60);
			$pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
			mail($_POST['email'], "Réinitialisation du mot de passe", 'Afin de changer votre mot de passe, veuillez cliquer sur ce lien : \n\n
				http://localhost/log_utilisateurs/page/reset.php?id={$user->id}&token=$reset_token');
			$_SESSION['flash']['success']='Les instructions du rappel de mot de passe vous ont été envoyées par email';
			header('Location: login.php');
			exit();
		}else{
			$_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
		}

	}

?>
<h1>Mot de passe oublié</h1>

	<form action="" method="POST">
	
	<div class="form-group">
		<label for="">email</label>	
		<input type="email" name="email" class = "form-control" >

	</div>

	<button type="submit" class="=btn btn-primary">Envoyer le mail de récupération</button>


	</form>

<?php require "../inc/footer.php" ?>