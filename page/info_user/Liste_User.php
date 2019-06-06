<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

$db = App::getDatabase();
if (!empty($_POST)){
    $validator = new Validator($_POST);
    $selected_val = $_POST['user'];

}
require "../../inc/ClubMenu.php"
?>


    <div class="table-responsive">
<h3>Liste des membres</h3>
        <table class="table table-striped table-bordere table-sm">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Actif</th>
                <th>TI</th>
                <th>QZ</th>
                <th>PH</th>
                <th>RR</th>

                <th>TT/PPL</th>
                <th>Cotis.</th>
                <!--<th>FNA</th>-->
                <th>Méd.</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
            $dbi->set_charset("utf8");
            $requete = 'SELECT * FROM t_pilote';
            $requete2 = 'SELECT * FROM t_autorise';
            $resultat = $dbi->query($requete);
            $auto = $dbi->query($requete2)->fetch_assoc();

            //Parcours du tableau de pilote récupéré et affichage des informations sous forme de tableau
            while ($ligne = $resultat->fetch_assoc()) {?>

            <tr>
                <td><?php echo $ligne['nom'] ?></td>
                <td><?php echo $ligne['prenom']?></td>
                <th><?php if($ligne['mActif'] == 1){echo "<span data-feather='check'>";}?></th>
                <!-- Récupération des informations concernant les autorisations de vol sur les avions pour le pilote-->
                <?php $requete2 = 'SELECT * FROM t_autorise where id_pilote = "'.$ligne['id'].'"';
                $auto = $dbi->query($requete2)->fetch_assoc();?>
                <th> <?php if($auto['TI'] >= 1){echo "<span data-feather='check'>";}?></span></th>
                <th><?php if($auto['QZ'] >= 1){echo "<span data-feather='check'>";}?></th>
                <th><?php if($auto['PH'] >= 1){echo "<span data-feather='check'>";}?></span></th>
                <th><?php if($auto['RR'] >= 1){echo "<span data-feather='check'>";}?></span></th>

                <th><?php if($ligne['datvaliditelicence'] != null){echo "<span data-feather='check'>";}?></span></th>
                <th><?php if($ligne['dateFinCotis'] != null){echo "<span data-feather='check'>";}?></th>
                <!--<th><span data-feather="check"></span></th>-->
                <th><?php if($ligne['datvaliditevisitemed'] !=null){echo "<span data-feather='check'>";}?></span></th>
                <th><a href="ModifMenu.php?id=<?php echo $ligne['id'] ?>" class="btn btn-sm mr-2"><span data-feather="eye"></span></a></th>
                <th><a href="ModifMenu.php?id=<?php echo $ligne['id'] ?>" class="btn btn-sm mr-2"><span data-feather="edit"></span></a></th>

            </tr>
            <?php }$dbi->close();?>

            </tbody>
        </table>
    </div>
    </main>
    </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <!--<script src="../../../../assets/js/vendor/popper.min.js"></script>-->
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>



<?php require "../../inc/newFooter.php" ?>