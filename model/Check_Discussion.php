<?php

require "../toolclass/variable.inc.php";

$CloseD = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscu'];

$query = "SELECT Distinct NomDiscussion FROM Discussion WHERE NomDiscussion='$NomD'";
$dbRowReq = $dbLink->prepare($query);
$dbRowReq->execute();
$dbRow = $dbRowReq->fetch();

//Si le bouton NameDiscu correspond bien
if ($_POST['BNameD'] == 'Ouvrir discussion') {
    if ($dbRow['NomDiscussion'] == NULL && strlen($NomD) != 0 && preg_match("#^[a-zA-Z0-9_]{3,30}$#", $NomD)) {
        //On crée une nouvelle discussion
        $query = 'INSERT INTO Discussion(NomDiscussion) VALUES(';
        $query .= '"' . $NomD . '")';
        $dbRowReq = $dbLink->prepare($query);
        $dbRowReq->execute();
        $dbRowReq->fetch();
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