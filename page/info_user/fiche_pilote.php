<?php
require "../../inc/functions.php";
logged_only();

require "../../inc/header_sous_dossier.php"
?>

<div class="container">
    <h1>Fiche pilote</h1>
    <div class="row">
        <h2>Suivi de la progression des élèves</h2>

    </div>

    <form>

        <div class="row">
            <div class="form-group mr-5">
                <label>Date du laché</label>
                <input type="Date" class="form-control">
            </div>
            <div class="form-group">
                <label>Nombre d'heures ou Notes</label>
                <input type="Number" class="form-control">
            </div>

        </div>



        <table class="table">
            <thead class="thead-dark">
            <tr>

                <th scope="col">PPL</th>
                <th scope="col">Théorique</th>
                <th scope="col">Pratique</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Date</th>
                <td><input type="Date" class="form-control"></td>
                <td><input type="Date" class="form-control"></td>

            </tr>
            <th scope="row">Nombre de tentatives</th>
            <td><input type="Number" class="form-control"></td>
            <td><input type="Number" class="form-control"></td>

            <tr>
            <th scope="row">Nombre d'heures ou Notes</th>
            <td><input type="Number" class="form-control"></td>


            </tr>

            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
            <tr>

                <th scope="col">BB</th>
                <th scope="col">Théorique</th>
                <th scope="col">Pratique</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Date</th>
                <td><input type="Date" class="form-control"></td>
                <td><input type="Date" class="form-control"></td>

            </tr>
            <th scope="row">Nombre de tentatives</th>
            <td><input type="Number" class="form-control"></td>
            <td><input type="Number" class="form-control"></td>

            <tr>
            <th scope="row">Nombre d'heures ou Notes</th>
            <td><input type="Number" class="form-control"></td>


            </tr>

            </tbody>
        </table>

        <label>Commentaires</label>
        <textarea class="form-control" rows="3"></textarea>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-danger">Annuler</button>
        <button type="button" class="btn btn-secondary ">Générer l'attestation de formation</button>
    </form>
</div>

<?php require "../../inc/footer.php" ?>