<?php require "../inc/functions.php";
require '../inc/bootstrap.php';?>

<?php

	if (!empty($_POST) && !empty($_POST['email'])) {
		# code...
		$db = App::getDatabase();
        $user = $db->query('SELECT * FROM t_pilote WHERE email=? && confirmed_at IS NOT null', [$_POST['email']])->fetch();

		//comparaison du mot de passe tapé et du mot de passe dans la BDD (celui stocké étant haché)
		if($user){
			$_SESSION['auth']=$user;

			$reset_token = str_random(60);
			$db->query('UPDATE t_pilote SET reset_token = ?, reset_at = NOW() WHERE id = ?',[$reset_token, $user->id]);

            // Préparation du mail contenant le lien d'activation
            $header = "MIME-Version: 1.0\r\n";
            $header.='From:"Aviabacus.com"<confirmation@compte.fr'."\n";
            $header.='Content-Type:text/html; charset="utf-8"'."\n";
            $header.='Content-Transfer-Encoding: 8bit';
            $destinataire = "antoine.quetin@gmail.com";
            $sujet = "Réinitalisation du mot de passe de mot de passe" ;
            $entete = "From: inscription@votresite.com" ;

            // Le lien d'activation est composé du login(log) et de la clé(cle)
            $message = '
                <html>
                    <body>
                    <div align="center">
                        Bienvenue sur VotreSite, <br />
 
                Afin de changer votre mot de passe, veuillez cliquer sur ce lien : <br/> 
				http://localhost/log_utilisateurs/page/reset.php?id='.$user->id.'&token='.$reset_token.'\'<br/>
 
 
                ---------------<br/>
                Ceci est un mail automatique, Merci de ne pas y répondre.
                    </div>
                          
                    </body>
                </html>       ';

            mail("test.aviabacus@gmail.com", "Réinitialisation du mot de passe", $message, $header) ; // Envoi du mail
			$_SESSION['flash']['success']='Les instructions du rappel de mot de passe vous ont été envoyées par email';
			header('Location: ../page/login.php');
			exit();
		}else{
			$_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
		}

	}
require "../inc/header.php";
?>
<h3>Mot de passe oublié</h3>

	<form action="" method="POST">
	
	<div class="form-group">
		<label for="">email</label>	
		<input type="email" name="email" class = "form-control" >

	</div>

	<button type="submit" class="=btn btn-primary">Envoyer le mail de récupération</button>


	</form>

<?php require "../inc/footer.php" ?>