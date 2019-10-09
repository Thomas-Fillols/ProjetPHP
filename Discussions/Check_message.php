<?php

$Participation = $_POST['Participation'];
$Submit = $_POST['Submit'];
$NbMots = explode(" ", $Participation);
var_dump($NbMots);
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
              <header> Bonjour votre participation a bien été envoyée. </header>
              <ul>
              </ul></body>' . PHP_EOL;
    $query = 'INSERT INTO Discussion(Participation)VALUES(';
    $query .= '"' . $Participation . '")';
}
    else if (sizeof($NbMots)>2){
        throw (new Exception('Vous voulez envoyer trop de mots'));
    }


    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo 'Erreur de requête<br/>';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    else {
    echo '<br/><strong> Bouton non géré!</strong>';
}