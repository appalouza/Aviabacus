<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();

if (!empty($_POST)){
    $db = App::getDatabase();
    $validator = new Validator($_POST);
    $errors = array();

    $validator->isAlphanumeric('codavioabrege', "Veuillez entrer un code avion valide");
    $validator->isAlphanumeric('codeassoc', "Veuillez entrer un code assoc valide");
    $validator->isAlphanumeric('typeavion', "Ce type d'avion n'est pas valide");
    $validator->isAlphanumeric('marque', 'Veuillez entrer une marque valide');
    $validator->isNumeric('puissance', 'Veuillez entrer une puissance valide');
    $validator->isNumeric('vitesse', 'Veuillez entrer une vitesse valide');
    $validator->isNumeric('consoreel', 'Veuillez entrer une consommation valide');
    $validator->isAlphanumeric('observations', "Votre commentaire n'est pas valide");
    $validator->isAlphanumeric('codeavion', "Votre code avion n'est pas valide");


    if($validator->isValid()){
        $db->query('INSERT INTO t_avion SET codavioabrege =?, codavion =?, codassoc = ?, typeavion = ?, marque = ?,
puissance = ? , vitesse = ?, consoreel = ?, observations = ?, prixheure = ?, en_flotte = ? ', [$_POST['codavioabrege'], $_POST['codeavion'],$_POST['codeassoc'],$_POST['typeavion'],
            $_POST['marque'],$_POST['puissance'],$_POST['vitesse'],$_POST['consoreel'],$_POST['observations'],$_POST['prixheure'],$_POST['cenflotte']]);
        $_SESSION['flash']['success'] = "Le nom à été modifié";

        header('Location: ../../page/avion/Liste_Avion.php');
        exit();
    }else{

        $validator->getErrors();
        }

}
require "../../inc/AvionMenu.php";
?>

<form action="" method="POST">

    <h2>Ajout d'un avion</h2>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label>Code abrégé</label>
            <input type="text" name="codavioabrege" class="form-control" ">
        </div>
        <div class="form-group col-md-2" >
            <label >Code avion</label>
            <input type="text" name="codeavion" class="form-control"" >
        </div>
        <div class="form-group col-md-2">
            <label >Code assoc</label>
            <input type="text" name="codeassoc" class="form-control" ">
        </div>
        <div class="form-group col-md-2">
            <label >Type avion</label>
            <input type="text" name="typeavion" class="form-control" ">
        </div>
        <div class="form-group col-md-2">
            <label >Marque</label>
            <input type="text" name="marque" class="form-control" ">
        </div>


    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label >Puissance</label>
            <input type="text" name="puissance" class="form-control" ">
        </div>
        <div class="form-group col-md-2">
            <label >Vitesse (km/h)</label>
            <input type="text" name="vitesse" class="form-control" ">
        </div>
        <div class="form-group col-md-3">
            <label >Consommation réelle (l/km)</label>
            <input type="text" name="consoreel" class="form-control" ">
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label >Observations </label>
            <textarea rows="5" name="observations" id="comment" class="form-control" placeholder="Si aucune observation veuillez remplir RAS."></textarea>
        </div>
        <div class="custom-control custom-radio">
            <label >En flotte</label><br/>

            <label class="radio-inline"><input type="radio" value="1" name="optradio" >Oui</label>
            <label class="radio-inline"><input type="radio" value="0" name="optradio">Non</label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="save">Enregistrer l'Avion</button>
        <a href="Liste_Avion.php" class="btn btn-primary">Retour à la liste</a>
    </div>
</form>


<?php require "../../inc/newFooter.php" ?>


