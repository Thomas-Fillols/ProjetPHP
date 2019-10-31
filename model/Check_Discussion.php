<?php

require "../include/function.inc.php";

$CloseD = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscu'];

function CloseDiscussion () {
    $query="SELECT NomDiscussion FROM Discussion WHERE NomDiscussion=NomDiscussion";
    $dbLink=call_data_base();
    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));
    echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Discussion fermée</title>
              </head>
              <body>
              <header> La discussion a bien été fermée </header>
              <ul>
              </ul></body>' . PHP_EOL;
    $query = 'INSERT INTO Discussion(FullMessage)VALUES(';
    $query .= '"' . 'Fin' . '")';
    if ($Close = !$_POST['Close discussion'])
        echo '<br/><strong>Bouton non géré !</strong>';

}
//Si le bouton NameDiscu correspond bien
if ($_POST['BNameD'] == 'Ouvrir discussion') {
    $query = "SELECT Distinct NomDiscussion FROM Discussion";
    $dbRowReq = $dbLink->prepare($query);
    $dbRox = $dbRowReq->fetch();
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
}