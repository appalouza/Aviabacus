<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
require "../../inc/ClubMenu.php"
?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Liste des élèves pilotes</h1>

            </div>


            <div class="table-responsive">

                <table class="table table-striped table-bordere table-sm">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Laché Date</th>
                        <th>Laché h.DC</th>
                        <th>Heures DC</th>
                        <th>Heures Solo</th>
                        <th>Théorique BB</th>
                        <th>Théorique PPL</th>
                        <th>Pratique BB</th>
                        <th>Pratique PPL</th>
                        <th>Validité Cotis.</th>
                        <th>Validité FNA</th>
                        <th>Validité Méd.</th>
                        <th>Actif</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ARMAND</td>
                        <td>Amanda</td>
                        <td type="date"></td>
                        <th>15,01</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>


                    </tr>
                    <tr>
                        <td>BARDET</td>
                        <td>Harris</td>
                        <td type="date">14/12/05</td>
                        <th>14,13</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>




                    </tr>
                    <tr>
                        <td>BARRAUD</td>
                        <td>Imélie</td>
                        <td type="date">24/04/11</td>
                        <th>16,49</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>


                    </tr>
                    <tr>
                        <td>BARRIERE</td>
                        <td>Heidi</td>
                        <td type="date">26/08/11</td>
                        <th>14,32</th>
                        <th>8,13</th>
                        <th>0,41</th>
                        <th></th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>



                    </tr>
                    <tr>
                        <td>BLANDIN</td>
                        <td>Werburge</td>
                        <td type="date"></td>
                        <th>15,01</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>


                    </tr>
                    <tr>
                        <td>CAM</td>
                        <td>Amabilis</td>
                        <td type="date">20/03/11</td>
                        <th>14,13</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>




                    </tr>
                    <tr>
                        <td>CHARDON</td>
                        <td>Paolina</td>
                        <td type="date"></td>
                        <th>16,49</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>


                    </tr>
                    <tr>
                        <td>CHOPIN</td>
                        <td>Lan</td>
                        <td type="date"></td>
                        <th>14,32</th>
                        <th>8,13</th>
                        <th>0,41</th>
                        <th></th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>



                    </tr>
                    <tr>
                        <td>CLAUDEL</td>
                        <td>Gonzague</td>
                        <td type="date"></td>
                        <th>15,01</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>


                    </tr>
                    <tr>
                        <td>DELANNOY</td>
                        <td>Ed</td>
                        <td type="date"></td>
                        <th>14,13</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>




                    </tr>
                    <tr>
                        <td>DENIAU</td>
                        <td>Hermeline</td>
                        <td type="date">03/07/09</td>
                        <th>16,49</th>
                        <th>0,00</th>
                        <th>0,00</th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>


                    </tr>
                    <tr>
                        <td>GAC</td>
                        <td>Pascalin</td>
                        <td type="date"></td>
                        <th>14,32</th>
                        <th>8,13</th>
                        <th>0,41</th>
                        <th></th>
                        <th> <span data-feather="check"></span></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>
                        <th><span data-feather="check"></span></th>
                        <th></th>
                        <th></th>
                        <th><span data-feather="check"></span></th>



                    </tr>
                    </tbody>
                </table>
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