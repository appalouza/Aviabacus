<?php
	//connexion à la bdd MySQL
	$pdo = new PDO('mysql:dbname=tuto_mdp;host=localhost','root','');
	//renvoie des messages en cas d'erreurs
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);