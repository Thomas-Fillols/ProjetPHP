<?php

require "../toolclass/function.inc.php";

//Connexion à la base de donnée
$dbLink=call_data_base();

//Récupération des variables
$Participation = $_POST['Participation'];
$NomD = $_POST['NomDiscussion'];

//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);


//Envoies de la participation
if ($SubmitPart == 'Send Participation' && sizeof($NbMots)<=2) {

    //Erreur s'il y a plus de deux mots
    if (sizeof($NbMots)>2)
        throw (new Exception('Vous voulez envoyer trop de mots'));
    //Erreur s'il y a trop de caractères
    elseif (strlen($Participation)>60)
        throw (new Exception('Trop de caractères'));
    else
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

//    Ajout du message dans Discussion
    $query = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
    $query .= '"'. $Participation . '",';
    $query .= '"'. 1 . '",';
    $query .= '"'. $Participation . '")';
    access_bd($dbLink, $query);

}

if ($_POST['CloseDisc']) {
    CloseDiscussion();
    echo 'La Discussion a été fermée';
}


if ($Submit =! $_POST['BPart'] && $NomD =! $_POST['BNameD'])
    echo '<br/><strong>Bouton non géré !</strong>';


