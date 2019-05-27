
<?php
require "../../inc/functions.php";
logged_admin();

require '../../inc/bootstrap.php';

// connection le bdd




//check les info sont enregistre ou non
if (!empty($_POST)) {

     $db = App::getDatabase();

     $errors = array();

     $validator = new Validator($_POST);


     $validator->isAlpha('nom_medecin', "Veuillez saisir le nom de médecin ");


    /* if($validator->isValid())
     {
        $restictions_medicales = strlen($restictions_medicales);

        }
        else {
            $erreur ="la limitation de text est 255 caractères.";
        }
     }*/

    /* $validator->isNumeric('datvaliditeppl', "Veuillez saisir une date de la licence TT/PPL");

     $validator->isNumeric('datvaliditelicence', "Veuillez saisir une date de la licence FFA");

     $validator->isNumeric('datvaliditelicence', "Veuillez saisir une date de la visite médicale");*/

     if ($validator->isValid()) {

         $db->query("INSERT INTO t_pilote SET 
                datvaliditeppl=?, datfinvaliditeppl=?,
                datvaliditelicence=?, datfinvaliditelicence=?,
                datvaliditevisitemed=?,datfinvaliditevisitemed=? " ,

                [$_POST['datvaliditeppl'],$_POST['datfinvaliditeppl'],
                $_POST['datvaliditelicence'], $_POST['datfinvaliditelicence'],
                $_POST['datvaliditevisitemed'], $_POST['datfinvaliditevisitemed']]
            );
         $_SESSION['flash']['success'] = "Un email de confirmation a été envoyé à l'utilisateur pour valider son compte";
        //redirection vers la page login.php
        header('Location: Inscription_coordonnées.php');
        exit();
     }
     else{
         $errors = $validator->getErrors();
     }
}

require "../../inc/header_sous_dossier.php"


?>

<div class="container">
    <h1>Licences - Visite médicale</h1>


    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas remplis le formulaire correctement </p>
            <?php foreach ($errors as $error): ?>
                <li><?=$error; ?> </li>
            <?php endforeach ?>

        </div>
    <?php endif; ?>


    <form action="" method="POST">
        <div class="form-row">
            <div class=" form-group col">
                <label>Validité de la licence TT/PPL</label>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date" name="datvaliditeppl" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" name="datfinvaliditeppl" class="form-control">
                    </div>
                </div>
            </div>

            <div class=" form-group col">
                <label>Validité de la licence FFA</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date" name="datvaliditelicence" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" name="datfinvaliditelicence" class="form-control">
                    </div>
                </div>
            </div>
            <div class=" form-group col">
                <label>Validité de la visite médicale</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date"  name="datvaliditevisitemed" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" name="datfinvaliditevisitemed" class="form-control">
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group col-6">
            <label>Nom du médecin</label>
            <input type="text" name="nom_medecin" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Réstrictions "éventuelles</label>
            <input type="text" name="restictions_medicales" class="form-control" >
            <textarea class="form-control" rows="3"></textarea>
        </div>


        <div class="form-group">
            <H2>Liste des qualifications</H2>
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Ajouter une qualification</button>


            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="container">
                            <div class="modal-header">
                                <h4 class="modal-title">Ajouter une qualification</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="form-group">
                                <label>Brevet/Qualification</label>
                                <select class="form-control">
                                    <option>Ancien Breveté brevet de base</option>
                                    <option>Ancien stagiaire déclaré</option>
                                    <option>Breveté pilote brevet de base</option>
                                    <option>CPL Pilote pro</option>
                                    <option>Stagiaire déclaré</option>
                                    <option>Hydravion</option>
                                    <option>Qualification IFR</option>
                                    <option>Instructeur FI, FI R et FE</option>
                                    <option>A préciser. Non connu</option>
                                    <option>Qualification B</option>
                                    <option>Qualification Nuit</option>
                                    <option>Qualification QRRI</option>
                                    <option>Breveté pilote complet TT/PPL</option>
                                    <option>Breveté pilote ULM</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date d'optention</label>
                                <input type="date" class="form-control">

                            </div>
                            <div class="form-group">
                                <label>Numéro</label>
                                <input type="number" class="form-control" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Brevets/Qualifications</th>
                <th scope="col">Date d'obtention</th>
                <th scope="col">Numéro</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hydravion</td>
                <td>17/08/2015</td>
                <td>BH879AH6</td>
                <td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>
            </tr>

            </tbody>
        </table>
        <button type="submit"  name="enregistrer" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-danger">Supprimer la fiche</button>

    </form>





</div>

<?php require "../../inc/footer.php" ?>





<!-- (!empty($_POST['datvaliditeppl'])AND!empty($_POST['datfinvaliditeppl'])AND!empty($_POST['datvaliditelicence'])AND!empty($_POST['datfinvaliditelicence'])AND!empty($_POST['datvaliditevisitemed'])AND!empty($_POST['datfinvaliditevisitemed'])AND!empty($_POST['nom_medecin'])AND!empty($_POST['restictions_medicales'])) -->