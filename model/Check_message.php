<?php
// Connexion à la base de données
try
{
    $dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


// Récupération de la Discussion
$dis = $dbLink->prepare('SELECT NomDiscussion, Id_Discussion FROM Discussion WHERE Id_Discussion = ?');
$dis->execute(array($_GET['Id_Discussion']));
$Ddis = $dis->fetch();

// Récupération des messages de la discussion
$FMess = $dbLink->prepare('SELECT FullMessage FROM FullMessage WHERE Id_Discussion = ?');
$FMess->execute(array($_GET['Id_Discussion']));
$DFMess = $FMess->fetch();

//Récupère le message en cours
$MessInPr = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ?');
$MessInPr->execute(array($_GET['Id_Discussion']));
$DMessInPr = $MessInPr->fetch();

?>
<?php

$dis->closeCursor(); //ibère le curseur pour la prochaine requête
$FMess->closeCursor();
$MessInPr->closeCursor();

// Récupération des messages
$req = $dbLink->prepare('SELECT * Message FROM Message WHERE Id_Discussion = ? ORDER BY Id_Message');
$req->execute(array($_GET['Discussion']));

while ($donnees = $req->fetch())
{
    ?>
    <p><strong><?php echo htmlspecialchars($donnees['Pseudo']); ?></strong></p>
    <p><?php echo nl2br(htmlspecialchars($donnees['Message'])); ?></p>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();



//Si le bouton d'arrêt de discussion est utilisé
//if ($CloseDisc == 'fermer discussion') {
//    $CloQuery = $dbLink->query("SELECT NomDiscussion FROM Discussion WHERE NomDiscussion=NomDiscussion");
//    $dbRow = mysqli_fetch_assoc(access_bd($dbLink, $CloQuery));
//    echo '<!DOCTYPE html>
//              <html lang="fr">
//              <head>
//              <title>Discussion fermée</title>
//              </head>
//              <body>
//              <header> La discussion a bien été fermée </header>
//              <ul>
//              </ul></body>' . PHP_EOL;
//    $CloQuery = 'INSERT INTO Discussion(FullMessage)VALUES(';
//    $CloQuery .= '"' . 'Finito!' . '")';
//}

//Envoies de la participation dans le message participatif
if ($SubmitPart == 'Send Participation') {

    //Si l'utilisateur est connecté
    if ($_SESSION['login'] == 'true') {

        //Erreur si la discussion a déjà été fermée
        if ($LastWord == 'Finito!')
            throw (new Exception('La Discussion est fermée'));
        //Erreur s'il y a plus de deux mots

        if (sizeof($NbMots) > 2)
            throw (new Exception('Vous voulez envoyer trop de mots'));
        //Erreur s'il y a 0 caractère

        if (strlen($Participation) == 0)
            throw (new Exception('Aucun Caracctère rentré'));

        //Erreur s'il y a trop de caractères
        if (strlen($Participation) > 50)
            throw (new Exception('Trop de caractères'));

        //Erreur si le bouton n'envoie pas la bonne valeur
        if ($Submit =! $_POST['BPart'])
            throw (new Exception('Bouton non reconnu'));
        //Erreur si l'utilisateur à déjà participé dans ce message

        if ("SELECT COUNT '$pseudo' FROM Message WHERE Id_Discussion='$IdDiscussion'" == 1)
            throw (new Exception('Vous avez déjà participé dans ce message'));

        //Si on envoi "Yolo." le message se ferme.
        else {
            if ($Participation == 'Yolo.') {
                $query = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
                $query .= '"' . $FMess . $Participation . '",';
                $query .= '"' . $IdDiscussion . '",';
                access_bd($dbLink, $query);

                $query = "DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'";
                access_bd($dbLink, $query);
                $FMess->closeCursor(); // Libération du curseur

                //Affiche "la réponse a bien été fermée"
                echo 'La Discussion a été fermée';
            }
            else{
                //    Ajout du message dans Discussion
                $query = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
                $query .= '"' . $Participation . '",';
                $query .= '"' . $IdDiscussion . '"';
                $query .= '"' . 'LOLILOL' . '")';
                $dbLink = call_data_base();
                access_bd($dbLink, $query);
            }
        }
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






