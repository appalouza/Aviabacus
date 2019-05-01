<?php 
session_start();
require "../inc/functions.php";
logged_only();

require "../inc/header.php"
?>

	<h2>Paramètres de votre compte: </h2>

		<a href="update-pwd.php">Changement de mot de passe</a>

	

<?php debug($_SESSION); ?>

<?php require "../inc/footer.php" ?>