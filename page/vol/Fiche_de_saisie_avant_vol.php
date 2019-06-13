<?php
require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_only();

if (!empty($_POST)){
   // var_dump($_POST['user']);
    if(!empty($_POST['user'])){
        $user_id = $_POST['user'];
        $_SESSION['user_id'] = $_POST['user'];

    }

    if (!empty($_POST['codinstr'])){

        $db = App::getDatabase();
        //création d'une méthode de detection d'erreurs utilisant un tableau
        $errors = array();

        /*$validator = new Validator($_POST);

        $validator->isNumeric('indlocal', "cet avion est invalide");
        if ($validator->isValid()) {
            $validator->isLen('indlocal', "cet avion a deja reservation ou en repaire");
        }

        $validator->isNumeric('nb_passagers', "4 personnes maximun");

        $validator->isNumeric('nbattero', "Veuillez saisir le nombre d'atterissages");

        $validator->isNumeric('nbrlitresav', "Veuillez saisir le nombre de litre d'essence ajouté avant le vol");

        $validator->isNumeric('nbrlitrhuav', "Veuillez saisir le nombre de litre d'huile ajouté avant le vol");


            $validator->isAlphanumeric('comPers', 'Le commentaire personnel est invalide');

            $validator->isAlphanumeric('comInstr', "Le commentaire de l'instructeur est invalide");

            $validator->isAlphanumeric('detSup', "Les détails supplémentaire sont invalides");
*/
//save data in bdd


            $token = Str::random(60);
            $requete = "INSERT INTO t_detailvol 
            SET  datDepartVol = ?,datArriveVol = ?, heureDepartVol = ?, 
            heureArriveVol = ?, id_pilote =?,  id_avion = ?, codinstr = ?, 
            nbattero = ?,
              nbrLitreEss=?, nbrLitreHuile=?,
             obsPers=?,aero_depart=?,aero_arrive=?,detSup=?,
            obsInstr=?,nb_passagers=?, typeVol = ?";
            $donnees = array( $_POST['datDepartVol'],$_POST['datArriveVol'],$_POST['heureDepartVol'],$_POST['heureArriveVol'],
                $_SESSION['user_id'],  $_POST['avion'], $_POST['codinstr'],
                 $_POST['nbattero'],
                $_POST['nbrLitreEss'], $_POST['nbrLitreHuile'],
                $_POST['obsPers'],  $_POST['aero_depart'], $_POST['aero_arrive'], $_POST['detSup'],
                 $_POST['obsInstr'],  $_POST['nb_passagers'], $_POST['typeVol']);

            $db->query($requete, $donnees);


    }
}

if ($_SESSION['auth']->level_user == "administrateur"){
    require "../../inc/AvionMenu.php";
}else{
    require "../../inc/AvionMenu.php";
}

?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas remplis le formulaire correctement </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>
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
            if ($ligne['id'] == $user_id){
                $select = "selected";
            }else $select = "";

            echo '<option ' . $select . ' value="'.$ligne['id'].'" >'.$ligne['nom'].' '.$ligne['prenom'].' </option>';
        }
        ?>
    </select>
        <button type="submit" class="btn btn-primary">Selectionner</button>
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
                        <select class="form-control" >
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
                    <select class="form-control" name="codinstr">
                        <option>Selectionnez un instructeur: </option>
                        <?php

                        $dbi->set_charset("utf8");

                        $requete = 'SELECT * FROM t_instruct';

                        $resultat = $dbi->query($requete);

                        while ($ligne = $resultat->fetch_assoc()) {


                            $instruct = $dbi->query('SELECT id, nom, prenom FROM t_pilote WHERE id = "'.$ligne['id_pilote'].'"')->fetch_assoc();
                            if($ligne['id_pilote'] != $user_id){
                                echo '<option  value="'.$ligne['id_pilote'].'" >'.$instruct['nom'].' '.$instruct['prenom'].'</option>';
                            }

                           }





                        ?>
                    </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nature du vol:</label>
                        <select class="form-control" required name="typeVol">
                            <option></option>
                            <option>Ecole - vol local</option>
                            <option>Ecole - tour de piste</option>
                            <option>Ecole - test renouvellement</option>
                            <option>Ecole - contrôle annuel</option>
                            <option>Ecole - test PPL</option>
                            <option>Ecole - tets prolongation</option>
                            <option>Ecole - navigation</option>
                            <option>Ecole - heure FI</option>
                            <option>Prive - local</option>
                            <option>Prive - tour de piste</option>
                            <option>Prive - navigation</option>
                            <option>Tours de piste</option>
                            <option>Tours de piste 1er laché</option>
                            <option>Test BB</option>
                            <option>Voyage</option>
                            <option>Local</option>
                            <option>Entrainement</option>
                            <option>Test V.F.R.</option>
                            <option>Navigation</option>
                            <option>Perfectionnement</option>
                            <option>Test PPL</option>
                            <option>Montagne</option>
                            <option>Vol d'initiation</option>
                            <option>Voyage à l'étranger</option>
                            <option>Formation VFR de nuit</option>
                            <option>Formation qualif. B</option>
                            <option>Formation voltige</option>
                            <option>V.F.R.</option>
                            <option>Convoyage</option>
                            <option>Parachutage</option>
                            <option>Vol professionnel</option>
                            <option>Point fixe</option>
                            <option>Remorquage</option>
                            <option>Test I.F.R.</option>
                            <option>Test voltige</option>
                            <option>Vol de contrôle mécanique </option>
                            <option>Voltige</option>
                            <option>Regime VFR de nuit</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nombre de passagers:</label>
                        <input type="number" class="form-control"name="nb_passagers" required>
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
                        <input type="Date" class="form-control" name="datDepartVol" required>
                        <input type="Date" class="form-control" name="datArriveVol" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Heure:</label>
                        <input type="time" class="form-control" name="heureDepartVol" required>
                        <input type="time" class="form-control" name="heureArriveVol" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Aéroport:</label>
                        <select class="form-control" name="aero_depart" required>
                            <option></option>
                            <option>Trebod</option>
                            <option>Buno</option>
                        </select>
                        <select class="form-control" name="aero_arrive" required>
                            <option></option>
                            <option>Trebod</option>
                            <option>Buno</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Durée estimée:</label>
                    <output name="durée_output" >HH-MM</output>
                </div>

                <div class="form-group">
                    <label>Nombre d'atterissages:</label>
                    <input type="number" class="form-control" name="nbattero" required>
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
                        <input type="number" class="form-control" value="0" name="nbrLitreEss" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Huile(L):</label>
                        <input type="number" class="form-control" value="0" name="nbrLitreHuile" required>
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
                    <textarea class="form-control" rows="3" name="detSup" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Commentaires personnels</label>
                    <textarea class="form-control" rows="3" name="obsPers" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Commentaires instructeur</label>
                    <textarea class="form-control" rows="3" name="obsInstr" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Enregistrer et retour</button>
            </form>
            <br>
</div>


<?php }  ?>

<?php require "../../inc/newFooter.php" ?>