<?php
	
	/**
	 * 
	 */
	class Database
	{	
		private $pdo;

		public function __construct($login, $password, $database_name = "tuto_mdp", $host = 'localhost'){

			//connexion à la bdd MySQL

			$this->pdo = new PDO("mysql:dbname=$database_name;host=$host",$login,$password);

			//renvoie des messages en cas d'erreurs

			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}

		//fonction qui renvoie une requête préparée en passant des paramètres

		public function query($query, $params = false)
		{
			//si on reçois des paramètres, on prépare te on éxecute  la requête
			if($params){
				$req = $this->pdo->prepare($query);
				$req->execute($params);
			}
			//sinon, 
			else{
				$req = $this->pdo->prepare($query);
			}
			
			return $req;
		}

		public function lastInsertId(){
			return $this->pdo->lastInsertId();

		}



	}