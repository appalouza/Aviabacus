<?php

//classe de connexion à la bdd

class App{

	static $db = null;
	static function getDatabase(){

		//lors du démarage, on initialise la variable db
		if (!self::$db) {
			# code...
			self::$db = new database('root', '');
		}
		

		return self::$db;
	}

	static function redirect($page){

	    header("Location: $page");

    }




}