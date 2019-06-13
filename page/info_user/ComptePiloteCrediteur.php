<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
require "../../inc/GestionMenu.php"
?>





          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Comptes créditeurs</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button class="btn btn-sm btn-outline-secondary mr-2">
                <span data-feather="printer"></span>
              </button>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                Aujourd'hui
              </button>
            </div>
          </div>


          <div class="table-responsive">
            <label>Solde final : -13789,98</label>
            <table class="table table-striped table-bordere table-sm">
              <thead>
                <tr>
                  <th>Pilote</th>
                  <th>Solde</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Lorem</td>
                  <td>1081,67</td>
                </tr>
                <tr>
                  <td>amet</td>
                  <td>384,98</td>
                </tr>
                <tr>
                  <td>Integer</td>
                  <td>138</td>
                </tr>
                <tr>
                  <td>libero</td>
                  <td>349</td>
                </tr>
                <tr>
                  <td>dapibus</td>
                  <td>674</td>
                </tr>
                <tr>
                  <td>Nulla</td>
                  <td>189,05</td>
                </tr>
                <tr>
                  <td>nibh</td>
                  <td>178,06</td>
                </tr>
                <tr>
                  <td>sagittis</td>
                  <td>133,07</td>
                </tr>
                <tr>
                  <td>Fusce</td>
                  <td>178,08</td>
                </tr>
                <tr>
                  <td>augue</td>
                  <td>389,09</td>
                </tr>
                <tr>
                  <td>massa</td>
                  <td>734,10</td>
                </tr>
              </tbody>
            </table>
          </div>


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