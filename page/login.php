<?php require "../inc/functions.php" ?>

<?php require "../inc/header.php" ?>

<?php

//reconnect_cookie();
	if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
		# code...
		require_once "../inc/header.php";
		require_once "../bdd/db.php";
		$req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email= :username) && confirmed_at IS NOT null');
		$req->execute(['username' => $_POST['username']]);
		$user = $req->fetch();
		//comparaison du mot de passe tapé et du mot de passe dans la BDD (celui stocké étant haché)
		if(password_verify($_POST['password'], $user->password)){
			session_start();
			$_SESSION['auth']=$user;
			$_SESSION['flash']['success']='Vous êtes maintenant bien connecté sur Aviabacus';

			/*if ($_POST['remember']) {
				# code...
				$remember_token=str_random(250);
				$pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

				setcookie('remember', $user->id.'=='.$remember_token.sha1($user->id .  'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
				
			}*/
			header('Location: account.php');
			exit();
		}else{
			$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect!';
		}

	}

?>
<h1>Se connecter</h1>

	<form action="" method="POST">
	
	<div class="form-group">
		<label for="">Pseudo ou email</label>	
		<input type="text" name="username" class = "form-control" >

	</div>


	<div class="form-group">
		<label for="">Mot de passe <a href="forget.php">J'ai oublié mon mot de passe</a></label>	
		<input type="password" name="password" class = "form-control" >

	</div>

	<div class="form-group">
		<label>
			<input type="checkbox" name="remember" value="1">Se souvenir de moi
		</label>

	</div>

	<button type="submit" class="=btn btn-primary">Se connecter</button>


	</form>

<?php require "../inc/footer.php" ?>