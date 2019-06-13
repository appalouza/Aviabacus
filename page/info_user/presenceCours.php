<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

require "../../inc/ClubMenu.php"
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Cours théoriques</h1>


</div>

<!-- Contenu de la page -->

<form>

    <div class="form-group col-3">
        <label>Cours numéro :</label>
        <input type="Text" class="form-control" >


    </div>

    <div class="form-group col-3">
        <label>Date du cours :</label>
        <input type="Date" class="form-control">
    </div>

    <div class="form-group col-3">
        <label>Instructeur</label>
        <select class="form-control">
            <option>Lorem</option>
            <option>Ipsum</option>
            <option>Ipsum</option>
            <option>Opalia</option>
            <option>Toto</option>
        </select>
    </div>





    <h3 class="mb-3">Matières abordées</h3>
    <div class="form-group form-check mb-3">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >A : Réglementation</label>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >B-1 : Connaissances générales</label>
    </div>
    <div class="form-group form-check mb-3">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >B-2 : Principes du vol</label>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >C-1 : Performances et préparation au vol</label>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >C-2 : Météorologie</label>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >C-3 : Navigation</label>
    </div>
    <div class="form-group form-check mb-3">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >C-4 : Procédures opérationnelles</label>
    </div>
    <div class="form-group form-check mb-3">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >D : Performance humaine et ses limites</label>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input">
        <label class="form-check-label" >E : Communication</label>
    </div>

    <h3>Liste des élèves</h3>
        <div class="table-responsive col-5">

            <button type="button" class="btn btn-outline-success mb-2">Ajouter un élève</button>

            <table class="table table-striped table-bordere table-sm">

                <tbody>
                <tr>
                    <td>GASNIER Jean</td>
                </tr>
                <tr>
                    <td>LOREM Ipsum</td>
                </tr>
                <tr>
                    <td>GASNIER Jean</td>
                </tr>
                <tr>
                    <td>LOREM Ipsum</td>
                </tr>

                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-info">Synthèse</button>
        <button type="button" class="btn btn-primary">Enregistrer</button>


</form>


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