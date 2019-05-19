<?php
require "../../inc/functions.php";
logged_only();

require "../../inc/header_sous_dossier.php"

?>

    <h4>Planche des vols:</h4>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date</th>
            <th>Avion</th>
            <th>Pilote</th>
            <th>Instructeur</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Temps de vol</th>
            <th>Essence utilisée</th>
            <th>Observations</th>
            <th>Validation</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>06/04/2019</td>
            <td>F BPRR</td>
            <td>Alex.Dumont</td>
            <td>John Doe</td>
            <td>12:00</td>
            <td>14:30</td>
            <td>02:30</td>
            <td>20L</td>
            <td>RAS</td>
            <td><div>
                    <input type="checkbox" id="scales" name="scales"
                           checked>

                </div></td>
            <td>
                <a href="edit.html">Modifier</a>
                <!-- <a href="#">Delete</a> -->
                <a (click)="deleteContact.ById(item.id,$event)" href="#">Delete</a>
            </td>
        </tr>

        <tr>
            <td>07/04/2019</td>
            <td>F BDTI</td>
            <td>Antoine Planche</td>
            <td>Kirk Douglas</td>
            <td>11:00</td>
            <td>11:30</td>
            <td>00:30</td>
            <td>5L</td>
            <td>RAS</td>
            <td><div>
                    <input type="checkbox" id="scales" name="scales"
                           checked>

                </div></td>
            <td>
                <a href="edit.html">Modifier</a>
                <!-- <a href="#">Delete</a> -->
                <a (click)="deleteContact.ById(item.id,$event)" href="#">Delete</a>
            </td>
        </tr>

        <tr>
            <td>06/04/2019</td>
            <td>F BPRR</td>
            <td>Marie Burgette</td>
            <td>Felix Chaise</td>
            <td>16:00</td>
            <td>17:00</td>
            <td>01:00</td>
            <td>10L</td>
            <td>RAS</td>
            <td><div>
                    <input type="checkbox" id="scales" name="scales"
                           checked>

                </div></td>
            <td>
                <a href="edit.html">Modifier</a>
                <!-- <a href="#">Delete</a> -->
                <a (click)="deleteContact.ById(item.id,$event)" href="#">Delete</a>
            </td>
        </tr>
        </tbody>

    </table>

<?php //debug($_SESSION); ?>

<?php require "../../inc/footer.php" ?>