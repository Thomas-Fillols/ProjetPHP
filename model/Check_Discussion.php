<?php

require "../include/function.inc.php";

$CloseD = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscu'];

try
{
    $dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$query = "SELECT Distinct NomDiscussion FROM Discussion WHERE NomDiscussion='$NomD'";
$dbRowReq = $dbLink->query($query);
$dbRow = $dbRowReq->fetch();

//Si le bouton NameDiscu correspond bien
if ($_POST['BNameD'] == 'Ouvrir discussion') {
    if ($dbRow['NomDiscussion'] == NULL) {
        //On crée une nouvelle discussion
        $dbLink = call_data_base();
        $query = 'INSERT INTO Discussion(NomDiscussion) VALUES(';
        $query .= '"' . $NomD . '")';
        access_bd($dbLink, $query);
        //On affiche cela
        echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Discussion ouverte</title>
              </head>
              <body>
              <header> La discussion a bien été ouverte </header>
              <ul>
              </ul></body>' . PHP_EOL;
    }
    else
        echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Nom invalide</title>
              </head>
              <body>
              <header> Le nom est déjà utilisé </header>
              <ul>
              </ul></body>' . PHP_EOL;
}