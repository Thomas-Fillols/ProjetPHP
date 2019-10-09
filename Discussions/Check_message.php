<?php

$Participation = $_POST['Participation'];
$Submit = $_POST['BPart'];
$Close = $_POST['CloseDisc'];
$NbMots = explode(" ", $Participation);
$dbLink = mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote', 'zawarudo')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink, 'freenote_sql')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));


if ($Submit == 'Send' && sizeof($NbMots)<=2) {

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
}
else if (sizeof($NbMots)>2)
    throw (new Exception('Vous voulez envoyer trop de mots'));

else if (sizeof($Participation)>60)
    throw (new Exception('Trop de caractères'));

if (!($dbResult = mysqli_query($dbLink, $query))) {
    echo 'Erreur de requête<br/>';
    // Affiche le type d'erreur.
    echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
    // Affiche la requête envoyée.
    echo 'Requête : ' . $query . '<br/>';
    exit();
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
    $query = 'INSERT INTO Discussion(Discussion)VALUES(';
    $query .= '"' . $Close . '")';
}

if($Submit=! $_POST['Send'] || $Close=! $_POST[('Close Discussion')])
    echo '<br/><strong> Bouton non géré!</strong>';