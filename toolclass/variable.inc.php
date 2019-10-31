<?php

//Récupération des variables discussion
$SubmitPart = $_POST['BPart'];
$FFullMess = 0;


$dbLink = mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote', 'zawarudo')
or die('Erreur de connexion au serveur:' . mysqli_connect_error());

mysqli_select_db($dbLink, 'freenote_sql')
or die('Erreur dans la sélection de la base:' . mysqli_error($dbLink));
return $dbLink;

$NomDiscus= mysqli_query("Select distinct NomDiscussion From Discussion");

if (!($dbResult = mysqli_query($dbLink, $NomDiscus))) {
    echo 'Erreur de requête<br/>';
    //Affiche le type d'erreur.
    echo 'Erreur:' . mysqli_error($dbLink) . '<br/>';
    //Affiche la requête envoyée.
    echo 'Requête:' . $NomDiscus . '<br/>';
    exit();
}
return $dbResult;
$TabNomDiscu=array();
