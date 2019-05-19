<?php
$dbi = new mysqli('localhost', 'root', '', 'tuto_mdp');



if($dbi->connect_errno){
    die('Sorry, we arehaving some problems.');
}