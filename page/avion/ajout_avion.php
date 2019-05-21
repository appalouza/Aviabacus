<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

if (!empty($_POST)){
    $db = App::getDatabase();

        $db->query('INSERT INTO t_avion SET codavioabrege =?, codavion =?, codassoc = ?, typeavion = ?, marque = ?,
puissance = ? , vitesse = ?, consoreel = ?, observations = ?, prixheure = ?, en_flotte = ? ', [$_POST['codabrege'], $_POST['codeavion'],$_POST['codeassoc'],$_POST['typeavion'],
            $_POST['marque'],$_POST['puissance'],$_POST['vitesse'],$_POST['consoreelle'],$_POST['observations'],$_POST['prixheure'],$_POST['cenflotte']]);
        $_SESSION['flash']['success'] = "Le nom à été modifié";

    header('Location: ../page/Liste_User.php');
    exit();
}
require "../../inc/header_sous_dossier.php";
?>

    <form method="post" action="">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Code abrégé</th>
                <th>Code avion</th>
                <th>Code assoc</th>
                <th>Type Avion</th>
                <th>Marque</th>
                <th>Puissance</th>
                <th>Vitesse</th>
                <th>Consommation réelle</th>
                <th>Observations</th>
                <th>Prix/heure</th>
                <th>En flotte</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="codabrege" class="form-control" ></td>
                <td><input type="text" name="codeavion" class="form-control" ></td>
                <td><input type="text" name="codeassoc" class="form-control" ></td>
                <td><input type="text" name="typeavion" class="form-control" ></td>
                <td><input type="text" name="marque" class="form-control" ></td>
                <td><input type="text" name="puissance" class="form-control" ></td>
                <td><input type="text" name="vitesse" class="form-control" ></td>
                <td><input type="text" name="consoreelle" class="form-control" ></td>
                <td><input type="text" name="observations" class="form-control" ></td>
                <td><input type="text" name="prixheure" class="form-control" ></td>
                <td><input type="text" name="enflotte" class="form-control" ></td>





            </tr>
            </tbody>



        </table>
        <button type="submit" class="btn btn-primary">Validation des modifications</button>
        <a href="Liste_Avion.php" class="btn btn-primary">Retour à la liste</a>
    </form>


<?php require "../../inc/footer.php" ?>


