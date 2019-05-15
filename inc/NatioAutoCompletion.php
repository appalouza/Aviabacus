<?php
require_once('../class/AutoCompletionNatio.class.php');

//Initialisation de la liste
$list = array();

//Connexion MySQL
try
{
    $db = new PDO('mysql:host=localhost;dbname=tuto_mdp', 'root', '');
}
catch (Exception $ex)
{
    echo $ex->getMessage();
}

//Construction de la requete
$strQuery = "SELECT PAYS nom_fr_fr FROM pays WHERE ";
if (isset($_POST["nationalite"]))
{
    $strQuery .= "PAYS LIKE :nationalite ";
}
/*
else
{
    $strQuery .= "VILLE LIKE :ville ";
}*/
$strQuery .= "AND CODEPAYS = 'FR' ";
//Limite
if (isset($_POST["maxRows"]))
{
    $strQuery .= "LIMIT 0, :maxRows";
}
$query = $db->prepare($strQuery);
if (isset($_POST["codePostal"]))
{
    $value = $_POST["codePostal"]."%";
    $query->bindParam(":codePostal", $value, PDO::PARAM_STR);
}
else
{
    $value = $_POST["ville"]."%";
    $query->bindParam(":ville", $value, PDO::PARAM_STR);
}
//Limite
if (isset($_POST["maxRows"]))
{
    $valueRows = intval($_POST["maxRows"]);
    $query->bindParam(":maxRows", $valueRows, PDO::PARAM_INT);
}

$query->execute();

$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionCPVille");;

echo json_encode($list);
?>
