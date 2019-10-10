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

    if (sizeof($NbMots)>2)
        throw (new Exception('Vous voulez envoyer trop de mots'));

    if (strlen($Participation)>60)
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


    $query ="SELECT D.Participation FROM Discussion D join Discussion Discu ON D.Discussion = Discu.Discussion WHERE D.Ndiscus=Discu.Ndiscus";
    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }
    $dbRow=mysqli_fetch_assoc($dbResult);
    var_dump($dbRow);
    $ExtractStr = extract($dbRow);
    var_dump($ExtractStr);
    $SearchParti = substr(extract($dbRow), 5);
    var_dump($SearchParti);
    $query = 'INSERT INTO Discussion(Participation, FullMessage)VALUES(';
    $query .= '"' . $Participation . '",';
    $query .= '"' . $SearchParti . $Participation . '")';

    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo 'Erreur de requête<br/>';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }

    if ($Submit =! $_POST['BPart'])
        echo '<br/><strong>Bouton non géré !</strong>';

}


$query="SELECT Ndiscus FROM Discussion WHERE Ndiscus>=Ndiscus";
if(!($dbResult=mysqli_query($dbLink, $query))){
    echo'Erreur de requête<br/>';
    //Affiche le type d'erreur.
    echo'Erreur:'.mysqli_error($dbLink).'<br/>';
    //Affiche la requête envoyée.
    echo'Requête:'.$query.'<br/>';
    exit();
}
$dbRow=mysqli_fetch_assoc($dbResult);

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
    $query = 'INSERT INTO Discussion(NDiscus, Participation)VALUES(';
    $query .= '"' . ($dbRow['Ndiscus']+1) . '",';
    $query .= '"' . 'Fin' . '")';
    if ($Close =! $_POST['Close discussion'])
        echo '<br/><strong>Bouton non géré !</strong>';
}


