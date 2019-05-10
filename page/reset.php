
<?php
require '../inc/bootstrap.php';
require '../inc/functions.php';
?>

<?php
if (!isset($_SESSION['auth'])){
    logout();
}

$user_id = $_GET['id'];
$token = $_GET['token'];

	if (isset($user_id) && isset($token)) {

        $db = App::getDatabase();
        //récupération d'info'mations de l'utilisateur
		$user = $db->query('SELECT * FROM t_pilote WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at >DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$user_id,$token])->fetch();

		if ($user) {
			//vérifications et changement de mot de passe
			if (!empty($_POST)) {
				# code...
				if (!empty($_POST['password']) && $_POST['password'] == $_POST['password-confirm']) {
					# code...
					$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
					$db->query('UPDATE t_pilote SET password = ?, reset_at = NULL, reset_token = NULL',[$password]);

					$_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";
					$_SESSION['auth'] = $user;
					header('Location: ../page/login.php');
					exit();
				}
			}
			
		}else{
		    $_SESSION['flash']['error'] = "Ce token n'est pas valide";
            header('Location: ../page/login.php');
            exit();
		}
	}
	else{
		header('Location: ../page/login.php');
	}
require "../inc/header.php";

?>
<h3>Réinitialisation du mot de passe</h3>

	<form action="" method="POST">

	<div class="form-group">
		<label for="">Mot de passe</label>	
		<input type="password" name="password" class = "form-control" >

	</div>

	<div class="form-group">
		<label for="">Confirmation du mot de passe</label>	
		<input type="password" name="password-confirm" class = "form-control" >

	</div>

	<button type="submit" class="=btn btn-primary">Réinitialiser mon mot de passe</button>


	</form>

<?php require "../inc/footer.php" ?>