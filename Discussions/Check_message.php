<?php

$Participation = $_POST['Participation'];
$Submit = $_POST['BPart'];
$Close = $_POST['CloseDisc'];
$NbMots = explode(" ", $Participation);
$dbLink = mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote', 'zawarudo')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink, 'freenote_sql')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
//$discu = mysqli_query($dbLink, 'SELECT Discussion FROM Discussion JOIN Discussion discu on Discussion.Discussion>discu.Discussion');
//var_dump($discu);
if ($Submit == 'Send' && sizeof($NbMots)<=2) {

    if (sizeof($NbMots)>2)
        throw (new Exception('Vous voulez envoyer trop de mots'));

    if (sizeof($Participation)>60)
        throw (new Exception('Trop de caractères'));

    echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Message envoyé</title>
              </head>
              <body>
              <header> Votre participation a bien été enregistrée. </header>
              <ul>
              </ul></body>' . PHP_EOL;

    $query = 'INSERT INTO Discussion(Participation)VALUES(';
    $query .= '"' . $Participation . '")';
    if ($Submit =! $_POST['BPart'])
        echo '<br/><strong>Bouton non géré !</strong>';
}


if ($Close == 'Close Discussion') {
    echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Discussion fermée</title>
              </head>
              <body>
              <header> La discussion a bien été fermée </header>
              <ul>
              </ul></body>' . PHP_EOL;
    $query = 'INSERT INTO Discussion(Discussion, Participation)VALUES(';
    $query .= '"' . $discu . '",';
    $query .= '"' . 'Fin' . '")';
    if ($Close =! $_POST['Close discussion'])
        echo '<br/><strong>Bouton non géré !</strong>';
}


if (!($dbResult = mysqli_query($dbLink, $query))) {
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $query . '<br/>';
    exit();
}
