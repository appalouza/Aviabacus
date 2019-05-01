<?php 
session_start();
require "../inc/functions.php";
logged_only();

require "../inc/header.php"

?>

	<h2>Vous êtes bien sur la page pilote!</h2>

		<h3>Bonjour <?= $_SESSION['auth']->username; ?></h3>

	

<?php debug($_SESSION); ?>

<?php require "../inc/footer.php" ?>