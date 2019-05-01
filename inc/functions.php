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
        header('Location: login.php');
        exit();
    	}
	}

	function reconnect_cookie(){

		if(session_status() == PHP_SESSION_NONE){
        session_start();
   		 }

   		if(isset($_SESSION['auth'])){
   		 	header('Location: account.php');
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
							header('Location: account.php');
						}else{
							setcookie('remember', NULL, -1 );
						}
				}else{
					setcookie('remember', NULL, -1 );
				}	
		}
	}


