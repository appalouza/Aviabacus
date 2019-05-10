<?php
require "../inc/functions.php";
logged_only();

require "../inc/header.php"

?>
<div>
    <h3>Bonjour <?= $_SESSION['auth']->prenom;?> <?= $_SESSION['auth']->nom;?>, bienvenue sur Aviabacus de l'Aéroclub Pierre Trébod,</h3>

    <ul>
        <li>votre compte est positif de : 65,00€</li>
        <li>vous n'avez aucun vol en attente</li>

    </ul>

    <div class="container">
        <h4>Planche des vols en cours:</h4>

        <table class="table">
            <thead>
            <tr>
                <th>Avion</th>
                <th>Status</th>

            </tr>
            </thead>
            <tbody>

            <tr class="table-success">
                <td>F BPRR</td>
                <td>DISPO</td>
            </tr>
            <tr class="table-success">
                <td>F BDTI</td>
                <td>DISPO</td>
            </tr>
            <tr class="table-success">
                <td>F BBQZ</td>
                <td>DISPO</td>
            </tr>
            <tr class="table-danger">
                <td>F BOPH</td>
                <td>ARRET</td>
            </tr>
            <tr class="table-success">
                <td>F BRVH</td>
                <td>DISPO</td>
            </tr>
            <tr class="table-danger">
                <td>F BNOZ</td>
                <td>ARRET</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<?php //debug($_SESSION); ?>

<?php require "../inc/footer.php" ?>