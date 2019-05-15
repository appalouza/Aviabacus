<?php

	function debug($variable){
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}

	function str_random($length){
		$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
	}



	function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: ../page/login.php');
        exit();
    	}
	}

function logged_admin(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth']) || $_SESSION['auth']->level_user != 'Administrateur'){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: ../page/login.php');
        exit();
    }
}

	function logout(){
        setcookie('remember', NULL, -1 );
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        unset($_SESSION['auth']);

        }

	function envoie_mail($user_id, $token){
        $header = "MIME-Version: 1.0\r\n";
        $header.='From:"Aviabacus.com"<confirmation@compte.fr'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $destinataire = "antoine.quetin@gmail.com";
        $sujet = "Activer votre compte" ;
        $entete = "From: inscription@votresite.com" ;

        // Le lien d'activation est composé du login(log) et de la clé(cle)
        $message = '
                <html>
                    <body>
                    <div align="center">
                        Bienvenue sur Aviabacus 2, <br />
 
                Pour activer votre compte, veuillez cliquer sur le lien ci dessous
                ou copier/coller dans votre navigateur internet. <br/>
 
                http://localhost/log_utilisateurs/page/confirm_2.php?id='.$user_id.'&token='.$token.'<br/>
 
 
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.
                    </div>
                          
                    </body>
                </html>       ';

        mail("test.aviabacus@gmail.com", "Confirmation du compte", $message, $header) ; // Envoi du mail
}

	/*function reconnect_cookie(){

		if(session_status() == PHP_SESSION_NONE){
        session_start();
   		 }

   		if(isset($_SESSION['auth'])){
   		 	header('Location: vol_info.php');
   		 	exit();
   		}


		if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){

			require_once "../bdd/db.php";
			$rember_token = $_COOKIE['remember'];


			explode('==', $remember_token);

			$user_id = $parts[0];

			$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');

			$req->execute([$user_id]);

			$user = $req->fetch();

				if ($user) {
					# code...
					$expected = $user->id.'=='.$remember_token.sha1($user->id .  'ratonlaveurs');
						if ($expected == $remember_token) {
						# code...
							session_start();
							$_SESSION['auth']=$user;
							setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
							$_SESSION['flash']['success']='Vous êtes maintenant bien connecté sur Aviabacus';
							header('Location: vol_info.php');
						}else{
							setcookie('remember', NULL, -1 );
						}
				}else{
					setcookie('remember', NULL, -1 );
				}	
		}
	}*/


