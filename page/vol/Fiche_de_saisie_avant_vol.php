<?php
require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_only();

if (!empty($_POST)){
    var_dump($_POST['user']);
    $user_id = $_POST['user'];

}

if ($_SESSION['auth']->level_user == "administrateur"){
    require "../../inc/AvionMenu.php";
}else{
    require "../../inc/AvionMenu.php";
}

?>
    <script src="../../js/main.js"></script>

<div class="container">
    <h3>Fiche de saisie avant le vol</h3>
            <br>
            <h4>Infos générales</h4>
            <br>
    <form method="post" action="">


    <select name="user" data-source ="/list.php?type=avion&filter=$id" id = "user" data-target="#avion" class="form-control linked-select">
        <option>Selection de l'utilisateur</option>
        <?php
        //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
        $dbi->set_charset("utf8");
        $requete = 'SELECT id, nom, prenom FROM t_pilote';
        $resultat = $dbi->query($requete);
        while ($ligne = $resultat->fetch_assoc()) {
            echo '<option value="'.$ligne['id'].'" >'.$ligne['nom'].' '.$ligne['prenom'].' </option>';
        }
        ?>
    </select>
        <button type="submit" class="btn-primary">Selectionner</button>
    </form>
<?php if(!empty($_POST)){?>


            <form method="post" action="">
                <div class="form-row">


                    <div class="form-group col-md-4">
                        <label>Avion: </label>

                        <select name = 'avion' id="avion" class="form-control ">
                            <option>Selectionnez un avion</option>
                            <?php

                            $dbi->set_charset("utf8");
                            $auto = array();
                            $requete = 'SELECT * FROM t_avion';
                            $requete2 = 'SELECT * FROM t_autorise where id_pilote = "'.$user_id.'"';
                            $resultat = $dbi->query($requete);
                            $auto = $dbi->query($requete2)->fetch_assoc();

                            while ($ligne = $resultat->fetch_assoc()) {

                                if ($ligne['en_flotte'] == 1){

                                        /*echo '<option >'.$auto['RR'].'</option>';*/

                                        if ($ligne["codavion"] == 'F BPRR' && $auto['RR'] >= 1){
                                            echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';
                                        }elseif ($ligne["codavion"] == 'F BDTI' && $auto['TI'] >= 1){

                                            echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';

                                        }elseif ($ligne["codavion"] == 'F BBQZ' && $auto['QZ'] >= 1){
                                            echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';
                                        }elseif ($ligne["codavion"] == 'F BOPH' && $auto['PH'] >= 1){

                                            echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';
                                        }

                                    }


                            }


                            ?>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fonction à bord:</label>
                        <select class="form-control">
                            <option>Selection d'une fonction: </option>
                            <option>Cdt de bord - Monomoteur - Jour</option>
                            <option>Double - Monomoteur - Jour</option>
                            <option>Pilote - Vols aux instruments</option>
                            <option>Double - Vols aux instruments</option>
                        </select>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label>Instructeur:</label>
                    <select class="form-control">
                        //bdd
                    </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nature du vol:</label>
                        <select class="form-control">
                            //bdd
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nombre de passagers:</label>
                        <input type="number" class="form-control">
                    </div>
                </div>

                <h4>Lieux et horaires</h4>
                <br>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label></label>
                        <br/>
                    <br/>
                        <label>Départ estimé:</label>
                        <br/>
                        <label>Arrivée estimée:</label>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Date du vol:</label>
                        <input type="Date" class="form-control">
                        <input type="Date" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Heure:</label>
                        <input type="time" class="form-control">
                        <input type="time" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Aéroport:</label>
                        <select class="form-control">
                            //bdd
                        </select>
                        <select class="form-control">
                            //bdd
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Durée estimée:</label>
                    <output name="durée_output">HH-MM</output>
                </div>

                <div class="form-group">
                    <label>Nombre d'atterissages:</label>
                    <input type="number" class="form-control">
                </div>


                <h4>Approvisionnement</h4>
                <br>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Ajout:</label>
                        <br>
                        <label>Avant le vol</label>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Essence(L):</label>
                        <input type="number" class="form-control" value="0">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Huile(L):</label>
                        <input type="number" class="form-control" value="0">
                    </div>
                </div>

                <h4>Coût</h4>
                <br>
                <div class="form-group">
                    <label>Montant estimé du vol:</label>
                    <output>0.00€</output>
                </div>

                <div class="form-group">
                    <label>Sans correctif d'essence</label>
                    <output>0.00€</output>
                </div>
                <label>Votre compte est de:</label>
                <output>0.00€</output>
                <br>
                <button type="submit" class="btn btn-primary">Approvisionner le compte</button>
                <button type="submit" class="btn btn-primary">Voir le relevé de compte</button>

                <h2>Observations</h2>
                <br>
                <div class="form-group">
                    <label>Détails supplémentaires concernant le vol</label>
                    <label>(en cas de voyage, merci d'indiquer la date et l'heure prévus de retour à St Cyr)</label>
                    <textarea class="form-control" rows="3"> </textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Commentaires personnels</label>
                    <textarea class="form-control" rows="3"> </textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Commentaires instructeur</label>
                    <textarea class="form-control" rows="3"> </textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Enregistrer et retour</button>
            </form>
            <br>
</div>


<?php } ?>

<?php require "../../inc/newFooter.php" ?>