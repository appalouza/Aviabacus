<?php

require '../../inc/bootstrap.php';
require "../../inc/functions.php";
require '../../inc/db.php';
logged_admin();
$id = $_GET['id'];
$db = App::getDatabase();
$resultat = $db->query('SELECT * FROM t_pilote WHERE id =?', [$id])->fetch();
$resultat2 = $db->query('SELECT * FROM t_autorise WHERE id_pilote = ?', [$id])->fetch();
$resultat3 = $db->query('SELECT * FROM t_licence WHERE id_pilote = ?', [$id])->fetch();
$resultat4 = $db->query('SELECT * FROM t_aeroclub WHERE id_pilote = ?', [$id])->fetch();
$pilote['modif'] = $resultat;
$autorise['modif'] = $resultat2;
$licence['modif'] = $resultat3;
$aeroclub['modif'] = $resultat4;


if (!empty($_POST)){

    $validator = new Validator($_POST);
    // Modification de la tabme t_pilote
    $requete = 'UPDATE t_pilote SET ';
    $donnees = array();
    $requete2 = "";
    $nb_donnee = 0;

    // Modification de la tabme t_autorise
    $automodif = 'UPDATE t_autorise SET ';
    $donnees2 = array();
    $automodif2 = "";
    $nb_donnee2 = 0;

    // Modification de la tabme t_licence
    $licencemodif = 'UPDATE t_licence SET ';
    $donnees3 = array();
    $licencemodif2 = "";
    $nb_donnee3 = 0;

    // Modification de la tabme t_aeroclub
    $aeroclubmodif = 'UPDATE t_aeroclub SET ';
    $donnees4 = array();
    $aeroclubmodif2 = "";
    $nb_donnee4 = 0;


    //initialisation d'un tableau d'erreurs vide, il se remplira si une erreur surviens
    $errors = array();

    //Test du nouveau nom, si le test est concluant, la requête SQL est modifiée pour mettre à jour le nouveau nom
    if ($_POST['nom']!=null){
        $nb_donnee++;

        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('nom', "Ce nom n'est pas valable");

        if ($validator->isValid()){
            $requete2 .='nom = ?';
            $donnees[] = $_POST['nom'];

        }
    }
    if ($_POST['sexe']!=null  && $_POST['sexe'] != $pilote['modif']->codsexe){
        $nb_donnee++;

        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $requete2 .='codsexe = ?';
        $donnees[] = $_POST['sexe'];


    }
    if ($_POST['prenom']!=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('prenom', "Ce prenom n'est pas valable");
        if ($validator->isValid()){
            $requete2 .='prenom = ?';
            $donnees[] = $_POST['prenom'];

        }
    }

    if ($_POST['email'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isEmail('email', "Cet email n'est pas valide");
        if ($validator->isValid()){
            $requete2 .='email = ?';
            $donnees[] = $_POST['email'];

        }
    }
    if ($_POST['lvl_user'] !=null && $_POST['lvl_user'] != $pilote['modif']->level_user){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }


        $requete2 .='level_user = ?';
        $donnees[] = $_POST['lvl_user'];


    }
    if ($_POST['nationalite'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('nationalite', 'Veuillez entrer une nationalité valide');
        if ($validator->isValid()){
            $requete2 .='nationalite = ?';
            $donnees[] = $_POST['nationalite'];

        }
    }
    if ($_POST['adresse'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlphanumeric('adresse', 'Veuillez entrer une adresse valide');
        if ($validator->isValid()){
            $requete2 .='adresse = ?';
            $donnees[] = $_POST['adresse'];

        }
    }
    if ($_POST['codpost'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isLen('codpost', 'Veuillez entrer un code postale valide');
        if ($validator->isValid()){
            $requete2 .='codpost = ?';
            $donnees[] = $_POST['codpost'];

        }
    }
    if ($_POST['ville'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('ville', 'Veuillez entrer une nationalité valide');
        if ($validator->isValid()){
            $requete2 .='ville = ?';
            $donnees[] = $_POST['ville'];

        }
    }
    if ($_POST['telcell'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('telcell', "Ce numéro de téléphone portable valide");
        if ($validator->isValid()){
            $requete2 .='telcellulaire = ?';
            $donnees[] = $_POST['telcell'];

        }
    }
    if ($_POST['teldom'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('teldom', "Ce numéro de téléphone domicile valide");
        if ($validator->isValid()){
            $requete2 .='teldomicile = ?';
            $donnees[] = $_POST['teldom'];

        }
    }
    if ($_POST['telpro'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('telpro', 'Veuillez entrer un téléphone pro valide');
        if ($validator->isValid()){
            $requete2 .='telpro = ?';
            $donnees[] = $_POST['telpro'];

        }
    }
    if ($_POST['profession'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('profession', 'Veuillez entrer une profession valide');
        if ($validator->isValid()){
            $requete2 .='profession = ?';
            $donnees[] = $_POST['profession'];

        }
    }
    if ($_POST['datenaissance'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $requete2 .='datnaissance = ?';
        $donnees[] = $_POST['datenaissance'];


    }
    if ($_POST['age'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('age', 'Veuillez entrer un age valide');
        if ($validator->isValid()){
            $requete2 .='age = ?';
            $donnees[] = $_POST['age'];

        }
    }
    if ($_POST['lieunaissance'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('lieunaissance', 'Veuillez entrer un lieu de naissance valide');
        if ($validator->isValid()){
            $requete2 .='lieunaissance = ?';
            $donnees[] = $_POST['lieunaissance'];

        }
    }
    if ($_POST['userFirstContactName'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('userFirstContactName', 'Veuillez entrer un nom de premier contact valide');
        if ($validator->isValid()){
            $requete2 .='userFirstContactName = ?';
            $donnees[] = $_POST['userFirstContactName'];

        }
    }
    if ($_POST['userFirstContactPhone'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('userFirstContactPhone', 'Veuillez entrer un téléphone de premier contact valide');
        if ($validator->isValid()){
            $requete2 .='userFirstContactPhone = ?';
            $donnees[] = $_POST['userFirstContactPhone'];

        }
    }
    if ($_POST['userSecondContactName'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlpha('userSecondContactName', 'Veuillez entrer un nom de second contact valide');
        if ($validator->isValid()){
            $requete2 .='userSecondContactName = ?';
            $donnees[] = $_POST['userSecondContactName'];

        }
    }
    if ($_POST['userSecondContactPhone'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isNumeric('userSecondContactPhone', 'Veuillez entrer un téléphone de second contact valide');
        if ($validator->isValid()){
            $requete2 .='userSecondContactPhone = ?';
            $donnees[] = $_POST['userSecondContactPhone'];

        }
    }

    if ($_POST['observations'] !=null){
        $nb_donnee++;
        if ($requete2 != null) {
            $requete2 .= ',';
        }
        $validator->isAlphanumeric('observations', 'Veuillez entrer une observation valide');
        if ($validator->isValid()){
            $requete2 .='Observations = ?';
            $donnees[] = $_POST['observations'];

        }
    }
    if ($_POST['datvaliditeppl'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }
            $licencemodif2 .='datvaliditeppl = ?';
            $donnees3[] = $_POST['datvaliditeppl'];

        }


    if ($_POST['datfinvaliditeppl'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }

            $licencemodif2 .='datfinvaliditeppl = ?';
            $donnees3[] = $_POST['datfinvaliditeppl'];


    }

    if ($_POST['datvaliditelicence'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }
            $licencemodif2 .='datvaliditelicence= ?';
            $donnees3[] = $_POST['datvaliditelicence'];


    }

    if ($_POST['datfinvaliditelicence'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }


        $licencemodif2 .='datfinvaliditelicence= ?';
        $donnees3[] = $_POST['datfinvaliditelicence'];


    }

    if ($_POST['datvaliditevisitemed'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }


        $licencemodif2 .='datvaliditevisitemed= ?';
        $donnees3[] = $_POST['datvaliditevisitemed'];


    }

    if ($_POST['datfinvaliditevisitemed'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }


        $licencemodif2 .='datfinvaliditevisitemed= ?';
        $donnees3[] = $_POST['datvaliditevisitemed'];


    }

    if ($_POST['nom_medecin'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }
        $validator->isAlpha('nom_medecin', 'Veuillez entrer un nom medecin');
        if ($validator->isValid()){
            $licencemodif2 .='nom_medecin = ?';
            $donnees3[] = $_POST['nom_medecin'];

        }
    }

    if ($_POST['restrictions_medicales'] !=null){
        $nb_donnee3++;
        if ($licencemodif2 != null) {
            $licencemodif2 .= ',';
        }
        $validator->isAlpha('restrictions_medicales', 'resticitions_medicales');
        if ($validator->isValid()){
            $licencemodif2 .='restrictions_medicales = ?';
            $donnees3[] = $_POST['restrictions_medicales'];

        }
    }
    if ($_POST['dateEntree']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
            $aeroclubmodif2 .='dateEntree = ?';
            $donnees4[] = $_POST['dateEntree'];

    }
    if ($_POST['dateCotis']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
            $aeroclubmodif2 .='dateCotis = ?';
            $donnees4[] = $_POST['dateCotis'];

    }
    if ($_POST['dateFinCotis']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
            $aeroclubmodif2 .='dateFinCotis = ?';
            $donnees4[] = $_POST['dateFinCotis'];
    }
    if ($_POST['mActif']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
        $validator->ismActif($_POST['mActif'], "Veuillez spécifié si actif");
        if ($validator->isValid()) {
            $aeroclubmodif2 .= 'mActif = ?';
            $donnees4[] = $_POST['mActif'];
        }
    }


    if ($_POST['RR'] != null){
        $nb_donnee2++;
        if ($automodif2 != null) {
            $automodif2 .= ',';
        }
        $automodif2 .='RR = ?';
        $donnees2[] = $_POST['RR'];

    }
    if ($_POST['TI'] != null){
        $nb_donnee2++;
        if ($automodif2 != null) {
            $automodif2 .= ',';
        }
        $automodif2 .='TI = ?';
        $donnees2[] = $_POST['TI'];

    }
    if ($_POST['QZ'] != null){
        $nb_donnee2++;
        if ($automodif2 != null) {
            $automodif2 .= ',';
        }
        $automodif2 .='QZ = ?';
        $donnees2[] = $_POST['QZ'];

    }
    if ($_POST['PH'] != null){
        $nb_donnee2++;
        if ($automodif2 != null) {
            $automodif2 .= ',';
        }
        $automodif2 .='PH = ?';
        $donnees2[] = $_POST['PH'];

    }

    if ($_POST['bours']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
        $validator->isBours($_POST['bours'], "Veuillez spécifier si bousier");
        if ($validator->isValid()) {
            $aeroclubmodif2 .= 'bours = ?';
            $donnees4[] = $_POST['bours'];
        }
    }
    if ($_POST['lMembre']!=null){
        $nb_donnee4++;
        if ($aeroclubmodif2 != null) {
            $aeroclubmodif2 .= ',';
        }
        $validator->isMembre($_POST['lMembre'], "Veuillez spécifier votre niveau de membre");

        if ($validator->isValid()) {
            $aeroclubmodif2 .= 'lMembre = ?';
            $donnees4[] = $_POST['lMembre'];
        }
    }

    if (sizeof($donnees4) == $nb_donnee4){
        $aeroclubmodif .= $aeroclubmodif2;
        $aeroclubmodif .= 'WHERE id_pilote = ?';
        $donnees4[] = $id;
        var_dump($aeroclubmodif);
        var_dump($donnees4);

        $db->query($aeroclubmodif,$donnees4);
        $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
    }

    if (sizeof($donnees3) == $nb_donnee3){
        $licencemodif .= $licencemodif2;
        $licencemodif .= 'WHERE id_pilote = ?';
        $donnees3[] = $id;
        var_dump($licencemodif);
        var_dump($donnees3);

        $db->query($licencemodif,$donnees3);
        $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
    }

    if (sizeof($donnees2) == $nb_donnee2){
        $automodif .= $automodif2;
        $automodif .= 'WHERE id_pilote = ?';
        $donnees2[] = $id;
        var_dump($automodif);
        var_dump($donnees2);

        $db->query($automodif,$donnees2);
        $_SESSION['flash']['success'] = "Les modifications ont été effectuées";
    }

    if (sizeof($donnees) == $nb_donnee){
        $requete .= $requete2;
        $requete .= 'WHERE id = ?';
        $donnees[] = $id;

        $db->query($requete, $donnees);
        $_SESSION['flash']['success'] = 'Les modifications ont été effectuées';
        unset($_POST);
        header('Location: Liste_User.php');
        exit();
    } else{
        $errors = $validator->getErrors();
        unset($_POST);
    }



}
require "../../inc/ClubMenu.php"
?>
    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>

    <script type="text/javascript" src="../../js/cp_auto.js"></script>
    <script type="text/javascript" src="../../js/calcullAge.js"></script>
    <script type="text/javascript" src="../../js/jquery.smartWizard.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <link href="../../css/smart_wizard.css" rel="stylesheet">

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas remplis le formulaire correctement </p>
        <?php foreach ($errors as $error): ?>
            <li><?=$error; ?> </li>
        <?php endforeach ?>

    </div>
<?php endif; ?>
    <h2>Modification du pilote <?php echo $pilote['modif']->prenom?> <?php echo $pilote['modif']->nom?></h2>

    <form action="" method="post">
            <!-- SmartWizard 2 html -->
            <div id="smartwizard2">
                <ul>
                    <li><a href="#step-1">Etape 1<br /><small>Coordonnées</small></a></li>
                    <li><a href="#step-2">Etape 2<br /><small>Aéroclub</small></a></li>
                    <li><a href="#step-3">Etape 3<br /><small>Licence - Visite Médicale</small></a></li>
                </ul>

                <div>
                    <div id="step-1" class="">
                        <h2>Modification des coordonnées</h2>
                        <?php require "../../page/info_user/CoordonnéesModif.php" ?>

                    </div>
                    <div id="step-2" class="">
                        <h2>Inscription Aéroclub</h2>
                        <?php require "../../page/info_user/AéroclubModif.php" ?>
                    </div>
                    <div id="step-3" class="">
                        <h2>Licence - Visite médicale</h2>
                        <?php require "../../page/info_user/LicenceModif.php" ?>
                    </div>

                </div>
            </div>



        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="../../js/jquery.smartWizard.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                //alert("You are on step "+stepNumber+" now");
                if(stepPosition === 'first'){
                    $("#prev-btn").addClass('enabled');
                }else if(stepPosition === 'final'){
                    $("#next-btn").addClass('enabled');
                }else{
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                .addClass('btn btn-info')
                .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                .addClass('btn btn-danger')
                .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Please note enabling option "showStepURLhash" will make navigation conflict for multiple wizard in a page.
            // so that option is disabling => showStepURLhash: false

            // Smart Wizard 2
            $('#smartwizard2').smartWizard({
                selected: 0,
                theme: 'default',
                transitionEffect:'fade',
                showStepURLhash: false
            });

        });
    </script>


<?php require "../../inc/footerInscription.php"?>