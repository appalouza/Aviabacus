<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

if(!empty($_POST['avion'])){
    if ($_POST['avion'] != 666){
        $id_avion = $_POST['avion'];
    }
    $dateHaute = $_POST['dateHaute'];
    $dateBasse = $_POST['dateBasse'];

}



require "../../inc/AvionMenu.php"
?>

    <script language="JavaScript">
        function imprime_zone(titre, obj)
        {
// Définie la zone à imprimer
            var zi = document.getElementById(obj).innerHTML;
// Ouvre une nouvelle fenetre
            var f = window.open("", "ZoneImpr", "height=500, width=600,toolbar=1, menubar=1, scrollbars=1, resizable=1,status=0, location=0, left=10, top=10");
// Définit le Style de la page
            f.document.body.style.color = '#000000';
            f.document.body.style.backgroundColor = '#FFFFFF';
            f.document.body.style.padding = "10px";
            //f.document.getElementById("titre").style.color = "#111111";
// Ajoute les Données
            f.document.title = titre;
            f.document.body.innerHTML += " " + zi + " ";
// Imprime et ferme la fenetre
            f.window.print();
            f.window.close();
            return true;
        }
    </script>

    <form action="" method="post">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Carnet de vol</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-sm btn-outline-secondary mr-2">
            <span onclick="imprime_zone('Tableau des vols du jour', 'tableau_dispo');" data-feather="printer"></span>
        </button>

        <div class="input-group mr-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Du</div>
            </div>
            <input name = "dateBasse" type="date" class="form-control" value="<?php if (!empty($dateBasse)){echo $dateBasse;}?>">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">Au</div>
            </div>
            <input name = "dateHaute" type="date" class="form-control" value="<?php if (!empty($dateHaute)){echo $dateHaute;}?>">
        </div>
    </div>

</div>

<!-- Contenu de la page -->

    <div class="row">
        <div class="form-group col-md-4">
            <label>Avion</label>
            <select name = 'avion' class="form-control ">
                <option value="666">Tous les avions </option>
                <?php
                $dbi->set_charset("utf8");
                $requete = 'SELECT * FROM t_avion';
                $resultat = $dbi->query($requete);

                while ($ligne = $resultat->fetch_assoc()) {
                    if ($ligne['id'] == $id_avion){
                        $select = "selected";
                    }else $select = "";
                    echo '<option ' . $select . ' value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';
                }

                ?>
            </select>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>


<div id = "tableau_dispo" class="table-responsive">

    <table class="table table-striped table-bordere table-sm">
        <thead>
        <tr>
            <th>Avion</th>
            <th id="titre">Date</th>
            <th>Pilote/Instructeur</th>
            <th>Type de vol</th>
            <th>Aéro Dep.</th>
            <th>Aéro Arr.</th>
            <th>Heure Dep.</th>
            <th>Heure Arr</th>
            <th>Durée</th>
            <th>Attero</th>
            <th>Essence Av.</th>
            <th>Essence Ap.</th>
            <th>Validation</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $resultat2 = $dbi->query('SELECT * FROM t_detailvol');

        //Parcours du tableau de pilote récupéré et affichage des informations sous forme de tableau
        while ($avion = $resultat2->fetch_assoc()) {

            $instr = $dbi->query('SELECT * FROM t_pilote WHERE id = "'.$avion['codinstr'].'"')->fetch_assoc();

            $avion2 = $dbi->query('SELECT * FROM t_avion WHERE id = "'.$avion['id_avion'].'"')->fetch_assoc();
            if (!empty($id_avion) && $avion['id_avion']== $id_avion){
            if (!empty($dateHaute) && empty($dateBasse)){
                if ($dateHaute >= $avion['datvol']){?>
                    <tr>
                        <td><?php echo $avion2['codavion'];?></td>
                        <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                        <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                        <td><?php echo $avion['typeVol'];?></td>
                        <td><?php echo $avion['aero_depart']; ?></td>
                        <td><?php echo $avion['aero_arrive']; ?></td>
                        <td><?php echo $avion['heureDepartVol']; ?></td>
                        <td><?php echo $avion['heureArriveVol']; ?></td>
                        <td>00:33</td>
                        <td><?php echo $avion['nbattero']; ?></td>
                        <td><?php echo $avion['nbrLitreEss']; ?></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php
                }

            }elseif (!empty($dateBasse) && empty($dateHaute)){
                if ($dateBasse <= $avion['datvol']){?>
                    <tr>
                        <td><?php echo $avion2['codavion'];?></td>
                        <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                        <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                        <td><?php echo $avion['typeVol'];?></td>
                        <td><?php echo $avion['aero_depart']; ?></td>
                        <td><?php echo $avion['aero_arrive']; ?></td>
                        <td><?php echo $avion['heureDepartVol']; ?></td>
                        <td><?php echo $avion['heureArriveVol']; ?></td>
                        <td>00:33</td>
                        <td><?php echo $avion['nbattero']; ?></td>
                        <td><?php echo $avion['nbrLitreEss']; ?></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php
            }
            }elseif (!empty($dateBasse) && !empty($dateHaute)){
                if ($dateBasse <= $avion['datvol'] && $dateHaute >= $avion['datvol']) { ?>
                    <tr>
                    <td><?php echo $avion2['codavion'];?></td>
                    <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                    <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                    <td><?php echo $avion['typeVol'];?></td>
                    <td><?php echo $avion['aero_depart']; ?></td>
                    <td><?php echo $avion['aero_arrive']; ?></td>
                    <td><?php echo $avion['heureDepartVol']; ?></td>
                    <td><?php echo $avion['heureArriveVol']; ?></td>
                    <td>00:33</td>
                    <td><?php echo $avion['nbattero']; ?></td>
                    <td><?php echo $avion['nbrLitreEss']; ?></td>
                    <td></td>
                    <td></td>

                    </tr><?php
                }
            }
            elseif (empty($dateBasse) && empty($dateHaute)){?>
                <tr>
                    <td><?php echo $avion2['codavion'];?></td>
                    <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                    <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                    <td><?php echo $avion['typeVol'];?></td>
                    <td><?php echo $avion['aero_depart']; ?></td>
                    <td><?php echo $avion['aero_arrive']; ?></td>
                    <td><?php echo $avion['heureDepartVol']; ?></td>
                    <td><?php echo $avion['heureArriveVol']; ?></td>
                    <td>00:33</td>
                    <td><?php echo $avion['nbattero']; ?></td>
                    <td><?php echo $avion['nbrLitreEss']; ?></td>
                    <td></td>
                    <td></td>

                </tr>

        <?php }
            }elseif (empty($id_avion)){
                if (empty($dateBasse) && empty($dateHaute)){

                ?>
                    <tr>
                        <td><?php echo $avion2['codavion'];?></td>
                        <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                        <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                        <td><?php echo $avion['typeVol'];?></td>
                        <td><?php echo $avion['aero_depart']; ?></td>
                        <td><?php echo $avion['aero_arrive']; ?></td>
                        <td><?php echo $avion['heureDepartVol']; ?></td>
                        <td><?php echo $avion['heureArriveVol']; ?></td>
                        <td>00:33</td>
                        <td><?php echo $avion['nbattero']; ?></td>
                        <td><?php echo $avion['nbrLitreEss']; ?></td>
                        <td></td>
                        <td></td>

                    </tr>
          <?php  }elseif (!empty($dateHaute) && empty($dateBasse)){
                    if ($dateHaute >= $avion['datvol']){?>
                        <tr>
                            <td><?php echo $avion2['codavion'];?></td>
                            <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                            <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                            <td><?php echo $avion['typeVol'];?></td>
                            <td><?php echo $avion['aero_depart']; ?></td>
                            <td><?php echo $avion['aero_arrive']; ?></td>
                            <td><?php echo $avion['heureDepartVol']; ?></td>
                            <td><?php echo $avion['heureArriveVol']; ?></td>
                            <td>00:33</td>
                            <td><?php echo $avion['nbattero']; ?></td>
                            <td><?php echo $avion['nbrLitreEss']; ?></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <?php
                    }

                }elseif (!empty($dateBasse) && empty($dateHaute)){
                    if ($dateBasse <= $avion['datvol']){?>
                        <tr>
                            <td><?php echo $avion2['codavion'];?></td>
                            <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                            <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                            <td><?php echo $avion['typeVol'];?></td>
                            <td><?php echo $avion['aero_depart']; ?></td>
                            <td><?php echo $avion['aero_arrive']; ?></td>
                            <td><?php echo $avion['heureDepartVol']; ?></td>
                            <td><?php echo $avion['heureArriveVol']; ?></td>
                            <td>00:33</td>
                            <td><?php echo $avion['nbattero']; ?></td>
                            <td><?php echo $avion['nbrLitreEss']; ?></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <?php
                    }
                }elseif (!empty($dateBasse) && !empty($dateHaute)){
                    if ($dateBasse <= $avion['datvol'] && $dateHaute >= $avion['datvol']) { ?>
                        <tr>
                        <td><?php echo $avion2['codavion'];?></td>
                        <td type="date"><?php echo $avion['datDepartVol']; ?></td>
                        <td><?php echo $instr['nom']; ?> <?php echo $instr['prenom']; ?></td>
                        <td><?php echo $avion['typeVol'];?></td>
                        <td><?php echo $avion['aero_depart']; ?></td>
                        <td><?php echo $avion['aero_arrive']; ?></td>
                        <td><?php echo $avion['heureDepartVol']; ?></td>
                        <td><?php echo $avion['heureArriveVol']; ?></td>
                        <td>00:33</td>
                        <td><?php echo $avion['nbattero']; ?></td>
                        <td><?php echo $avion['nbrLitreEss']; ?></td>
                        <td></td>
                        <td></td>

                        </tr><?php
                    }
                }
        }}$dbi->close();?>

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
<script src="../../../../assets/js/vendor/popper.min.js"></script>
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