
<?php

require '../inc/bootstrap.php';
require "../inc/functions.php";
require '../test_menu/db.php';
logged_admin();
require "../inc/header.php";
?>
<h1>Suppression d'un utilisateurs</h1>

<h2>Voulez-vous supprimer <?php echo $_SESSION['modif']->nom?> <?php echo $_SESSION['modif']->prenom?></h2>

<button type="submit" class="btn btn-primary" value="0">Suppression</button>
<button type="submit" class="btn btn-primary" value="1">Ne pas supprimer</button>

<?php require "../inc/footer.php" ?>
