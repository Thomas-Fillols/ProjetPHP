<?php

require "../toolclass/function.inc.php";

//Connexion à la base de donnée
try
{
    $dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

//Récupération des variables
$Participation = $_POST['Participation'];
$NomD = $_POST['NomDiscussion'];
$SubmitPart = $_POST['BPart'];
$CloseMessage = $_POST['CloseMess'];

//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);

//Récupération de l'ID de la discussion
$IdDiscussion=("SELECT Id_Discussion FROM Discussion WHERE NomDiscussion = '$pageCourante'");



// Récupération de la discussion
$req = $dbLink->prepare("SELECT NomDiscussion, FullMessage FROM Discussion WHERE Id_Discussion = '$IdDiscussion'");
$req->execute(array($_GET['Discussion']));
$donnees = $req->fetch();

// Récupération des participations pour un message
$FMess = $dbLink->prepare("SELECT Message FROM Message WHERE Id_Discussion = '$IdDiscussion'");



if ($NbMessageDiscussion == '10') {
    $query = "SELECT NomDiscussion FROM Discussion WHERE NomDiscussion=NomDiscussion";
    $dbLink = call_data_base();
    $dbRow = mysqli_fetch_assoc(access_bd($dbLink, $query));
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
    $query .= '"' . 'Finito!' . '")';
}

//Envoies de la participation dans le message participatif
if ($SubmitPart == 'Send Participation') {

    //Si l'utilisateur est connecté
    if ($_SESSION['login']=='true') {

        //Erreur si la discussion a déjà été fermée
        if($LastWord == 'Finito!')
            throw (new Exception('La Discussion est fermée');

        //Erreur s'il y a plus de deux mots
        elseif (sizeof($NbMots) > 2)
            throw (new Exception('Vous voulez envoyer trop de mots'));

        //Erreur s'il y a 0 caractère
        elseif (strlen($Participation) == 0)
            throw (new Exception('Aucun Caracctère rentré'));

        //Erreur s'il y a trop de caractères
        elseif (strlen($Participation) > 50)
            throw (new Exception('Trop de caractères'));

        //Erreur i le bouton n'envoie pas la bonne valeur
        elseif ($Submit = !$_POST['BPart'])
            throw (new Exception('Bouton non reconnu'));

        //Si on envoi "Yolo." le message se ferme.
        elseif ($Participation == 'Yolo.') {
            $query = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
            $query .= '"' . $FMess . $Participation . '",';
            $query .= '"' . $IdDiscussion . '",';
            access_bd($dbLink, $query);

            $query = "DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'";
            access_bd($dbLink, $query);

            $FMess->closeCursor(); // Libération du curseur

            //Affiche "la réponse a bien été envoyée"
            echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Message fermé</title>
              </head>
              <body>
              <header> Le message a été fermé. </header>
              <ul>
              </ul></body>' . PHP_EOL;
        } else {

            //    Ajout du message dans Discussion
            $query = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
            $query .= '"' . $Participation . '",';
            $query .= '"' . $IdDiscussion . '",';
            $query .= '"' . $pseudo . '")';
            access_bd($dbLink, $query);

            //Affiche "la réponse a bien été envoyée"
            echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Message envoyé</title>
              </head>
              <body>
              <header> Votre participation a bien été enregistrée. </header>
              <ul>
              </ul></body>' . PHP_EOL;
        }
    }
    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

}






