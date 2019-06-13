<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
require "../../inc/GestionMenu.php"
?>


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Saisie d'une opération diverse</h1>
                <div class="btn-toolbar mb-2 mb-md-0">




                </div>

            </div>

            <!-- Contenu de la page -->


            <div class="row">
                <div class="col-3">
                    <label>Pilote:</label>
                    <select class="form-control mb-1">
                        <option>LEBAS Havoise</option>
                        <option>LEBEAU Gibert</option>
                        <option>LEBLOND Pasteur</option>
                        <option>LECOCQ Gisbert</option>
                        <option>LECUYER Hassan</option>


                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label>Compte:</label>
                    <select class="form-control mb-1">
                        <option>Pilotes - compte courant</option>
                        <option>C/C membres - Fin.RR</option>
                        <option>C/C membres - Fin.Trésorerie</option>
                    </select>
                </div>
            </div>



            <div class="form-row ">
                <div class="form-group mr-3">
                    <label>Date d'Operation:</label>
                    <input type="Date" class="form-control" >
                </div>

                <div class="form-group">
                    <label>Montant:</label>
                    <input type="number" class="form-control" >
                </div>
            </div>



            <div class="form-group mt-3 ">
                <label>Bordereau de dépot:</label>
                <input type="text" class="form-control col-6" >
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" >
                <label>Validation</label>
            </div>






            <div class="form-group">
                <label>Commentaires:</label>
                <textarea class="form-control col-6" > </textarea>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
            <br>







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