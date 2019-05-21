<?php
require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_only();

require "../../inc/header_sous_dossier.php"
?>
<body>

<div class="container">
    <h3>Fiche de saisie avant le vol</h3>
            <br>
            <h4>Infos générales</h4>
            <br>

            <form method="post" action="">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Avion: </label>

                        <select name = 'avion' class="form-control ">
                            <option>Selectionnez un avion</option>
                            <?php
                            $dbi->set_charset("utf8");
                            $requete = 'SELECT * FROM t_avion';
                            $resultat = $dbi->query($requete);

                            while ($ligne = $resultat->fetch_assoc()) {
                                if ($ligne['en_flotte'] == 1){
                                    echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].'</option>';
                                }
                            }


                            ?>

                        </select>
                    </div>
                </div>



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



                    <div class="form-group col-md-4">
                        <label>Fonction à bord:</label>
                        <select class="form-control">
                            <option>Cdt de bord - Monomoteur - Jour</option>
                            <option>Double - Monomoteur - Jour</option>
                            <option>Pilote - Vols aux instruments</option>
                            <option>Double - Vols aux instruments</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <label>Instructeur:</label>
                    <select class="form-control">
                        //bdd
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nature du vol:</label>
                        <select class="form-control">
                            //bdd
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
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
<?php //debug($_SESSION); ?>

<?php require "../../inc/footer.php" ?>