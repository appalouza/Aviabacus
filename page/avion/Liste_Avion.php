<?php


require "../../inc/functions.php";
require '../../inc/db.php';
require "../../class/app.php";
require "../../class/database.php";
logged_admin();
$db = App::getDatabase();


require "../../inc/AvionMenu.php"
?>

    <h1>Liste des avions</h1>

        <div class="form-row">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Avion</th>
                        <th>Status</th>
                        <th>Association</th>
                        <th>Options</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
                    $dbi->set_charset("utf8");
                    $requete = 'SELECT * FROM t_avion';
                    $resultat = $dbi->query($requete);
                    while ($ligne = $resultat->fetch_assoc()) {?>
                    <tr class="<?php
                    if ($ligne['en_flotte'] == 1){
                        echo 'table-success';
                    }elseif ($ligne['en_flotte'] == 0){
                        echo 'table-danger';
                    }
                    ?>">

                        <td><?php echo $ligne['codavion'] ?> </td>
                        <td><?php if ($ligne['en_flotte'] == 1){
                                echo 'DISPO';
                            }elseif ($ligne['en_flotte'] == 0){
                                echo 'ARRET';
                            }
                            ?></td>
                        <td><?php echo $ligne['codassoc']?></td>

                        <td>
                            <a class="btn btn-primary" href="modif_avion.php?id=<?php echo $ligne['id'];?>">Modifier</a>

                        </td>

                    </tr>
                    <?php }$dbi->close();?>
                    </tbody>
                </table>

            </div>
        </div>

        <!--<a href="ajout_avion.php" class="btn btn-primary">Ajouter un avion</a>-->

<?php require "../../inc/newFooter.php" ?>