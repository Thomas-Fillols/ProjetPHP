<?php

include "Check_Discussion.php";

//Connexion à la base de donnée
$dbLink=call_data_base();
//Envoies de la participation
if ($Submit == 'Send' && sizeof($NbMots)<=2) {
    //Erreur s'il y a plus de deux mots
    if (sizeof($NbMots)>2)
        throw (new Exception('Vous voulez envoyer trop de mots'));
    //Erreur s'il y a trop de caractères
    if (strlen($Participation)>60)
        throw (new Exception('Trop de caractères'));
    //Affichage pour montrer que la réponse a bien été envoyée
    echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Message envoyé</title>
              </head>
              <body>
              <header> Votre participation a bien été enregistrée. </header>
              <ul>
              </ul></body>' . PHP_EOL;
    //Close Discussion
    if ($Close == 'Close Discussion') {
        CloseDiscussion();
    }

//    Ajout de la participation dans Discussion
    $query ="SELECT D.FullMessage FROM Discussion D join Discussion Disc ON D.NumPart = Disc.NumPart WHERE D.Ndiscus= '$FFullMess'";
    $dbResult=access_bd($dbLink, $query);
    $dbRow=mysqli_fetch_assoc($dbResult);
    $query = 'INSERT INTO Discussion(Participation, FullMessage)VALUES(';
    $query .= '"'. $Participation . '"';
    $query .= '"' . Fullmessage() . '")';
    access_bd($dbLink, $query);

    if ($Submit =! $_POST['BPart'])
        echo '<br/><strong>Bouton non géré !</strong>';

}





