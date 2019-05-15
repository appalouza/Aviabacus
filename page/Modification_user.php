<?php

require '../inc/bootstrap.php';
require "../inc/functions.php";
require '../test_menu/db.php';
logged_admin();

$db = App::getDatabase();
if (!empty($_POST)){
    $selected_val = $_POST['user'];
    echo $selected_val;



   // $user = $db->query('SELECT * FROM t_pilote WHERE id=?', $user_id );

}
require "../inc/header.php"
?>

<h1>Modification d'un utilisateur</h1>
<form method="post" action="">
    <div class="form-row">
        <div class="form-group col-md-6">

            <label>Liste des utilisateurs</label>
            <select name="user" class="form-control col-md-6">
                <option>Selection de l'utilisateur</option>
                <?php
                //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
                $dbi->set_charset("utf8");
                $requete = 'SELECT * FROM t_pilote';
                $resultat = $dbi->query($requete);
                while ($ligne = $resultat->fetch_assoc()) {
                    echo '<option value="'.$ligne['id'].'" >'.$ligne['nom'].' '.$ligne['prenom'].' </option>';
                }

                $dbi->close();
                ?>
            </select>

        </div>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
    <?php

        $resultat = $db->query('SELECT * FROM t_pilote WHERE id =?', [$selected_val])->fetch();
        $_SESSION['modif']=$resultat;
       ?>
    <table class="table table-striped">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Options</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $_SESSION['modif']->nom?> </td>
        <td><?php echo $_SESSION['modif']->prenom?></td>
        <td><?php echo $_SESSION['modif']->email?></td>
        <td>
            <a href="edit.html">Modifier</a>
            <!-- <a href="#">Delete</a> -->
            <!--(click)="deleteContact.ById(item.id,$event)"-->
            <a href="../page/delete_user.php">Delete</a>
        </td>
    </tr>
    </tbody>


</table>





<?php require "../inc/footer.php" ?>