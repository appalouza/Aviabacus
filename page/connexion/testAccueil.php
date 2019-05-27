<?php
require "../../inc/functions.php";
require '../../inc/db.php';


require "../../inc/newMenu.php"

?>
    <div>


        <ul>
            <li>votre compte est positif de : 65,00€</li>
            <li>vous n'avez aucun vol en attente</li>

        </ul>

        <div class="form-row">
            <div class="container">


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Avion</th>
                        <th>Status</th>

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

                            <td><?php echo $ligne['codavion']?> </td>
                            <td><?php if ($ligne['en_flotte'] == 1){
                                    echo 'DISPO';
                                }elseif ($ligne['en_flotte'] == 0){
                                    echo 'ARRET';
                                }
                                ?></td>


                        </tr>
                    <?php }$dbi->close();?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>

<?php //debug($_SESSION); ?>

<?php require "../../inc/footer.php" ?>