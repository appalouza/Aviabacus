<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

require "../../inc/header_sous_dossier.php";
?>

<h1>Modification d'un avion:</h1>

    <form action="" method="POST">
        <!--	<div class="form-group">
                <picture>
                    <img src="img_orange_flowers.jpg" alt="Photo" style="width:auto;">
                </picture>
                <input type="file" name="userProfilPicture" class="form-control">
            </div>-->
        <h2>Coordonnées</h2>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Code abrégé</label>
                <input type="text" name="codabrege" class="form-control" >
            </div>
            <div class="form-group col-md-2" >
                <label >Code avion</label>
                <input type="text" name="codeavion" class="form-control" >
            </div>
            <div class="form-group col-md-2">
                <label >Code assoc</label>
                <input type="text" name="codeassoc" class="form-control" >
            </div>
            <div class="form-group col-md-2">
                <label >Type avion</label>
                <input type="text" name="typeavion" class="form-control" >
            </div>
            <div class="form-group col-md-2">
                <label >Marque</label>
                <input type="text" name="marque" class="form-control" >
            </div>

        </div>

    </form>


<?php require "../inc/footer.php" ?>