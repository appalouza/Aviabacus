<?php



if (isset($_POST["bureau"]) && !empty($_POST["bureau"])) {
    $requete = $dbi->query("SELECT DISTINCT Poste FROM room WHERE Bureau = " . $_POST['bureau'] . " AND disponible = 'Libre' ORDER BY Poste ASC");

    //Count total number of rows
    $rowCount = $requete->num_rows;
    if ($rowCount > 0) {
        echo '<option value="">Sélectionnez un Poste</option>';
        while ($row = $requete->fetch_assoc()) {
            {
                echo '<option value="' . $row['id'] . '">' . $row['Poste'] . '</option>';
            }
        }
    } else {
        echo '<option value="">Poste non disponible</option>';
    }
}
