<?php
require '../toolclass/variable.inc.php';

//Récupération de l'Id de la discussion
$IdDisc = $_GET['Id_Discussion'];

//Récupération de l'état de la discussion
$clos = $dbLink->prepare('SELECT Closed FROM Discussion WHERE Id_Discussion = ?');
$clos->execute(array($IdDiscussion));
$DClos = $clos->fetch();

// Récupération de la Discussion
$dis = $dbLink->prepare('SELECT NomDiscussion, Id_Discussion FROM Discussion WHERE Id_Discussion = ?');
$dis->execute(array($IdDiscussion));
$Ddis = $dis->fetch();

// Récupération des messages de la discussion
$FMess = $dbLink->prepare('SELECT FullMessage FROM FullMessage WHERE Id_Discussion = ?');
$FMess->execute(array($IdDiscussion));
$DFMess = $FMess->fetchAll();

//Récupère le message en cours
$MessInPr = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ?');
$MessInPr->execute(array($IdDiscussion));
$DMessInPr = $MessInPr->fetchAll();

$clos->closeCursor();
$dis->closeCursor(); //Libère le curseur pour la prochaine requête
$FMess->closeCursor();
$MessInPr->closeCursor();

// Récupération des messages
$req = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ? ORDER BY Id_Message');
$req->execute(array($_GET['Discussion']));

while ($donnees = $req->fetch())
{
    ?>
    <p><strong><?php echo htmlspecialchars($donnees['Pseudo']); ?></strong></p>
    <p><?php echo nl2br(htmlspecialchars($donnees['Message'])); ?></p>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();

//Envoies de la participation dans le message participatif
if (isset($_POST['BPart'])) {

    //Message participatif: bloquage
    $dbLink = call_data_base();
    $block  = "SELECT '$pseudo' FROM Message WHERE Id_Discussion='$IdDiscussion'";
    access_bd($dbLink, $block);

    //Erreur si la discussion a déjà été fermée
    if ($LastWord == 'Finito!')
        throw (new Exception('La Discussion est fermée'));
    //Erreur s'il y a plus de deux mots

    if (sizeof($NbMots) > 2)
        throw (new Exception('Vous voulez envoyer trop de mots'));

    //Erreur s'il y a 0 caractère
    if (strlen($Participation) == 0)
        throw (new Exception('Aucun Caractère rentré'));

    //Erreur s'il y a trop de caractères
    if (strlen($Participation) > 50)
        throw (new Exception('Trop de caractères'));

    //Erreur si le bouton n'envoie pas la bonne valeur
    if ($Submit = !$_POST['BPart'])
        throw (new Exception('Bouton non reconnu'));

//    //Erreur si l'utilisateur à déjà participé dans ce message
//    if ($block =! NULL)
//        throw (new Exception('Vous avez déjà participé dans ce message'));

    //Si on envoi "Yolo." le message se ferme.

    if ($Participation == 'Yolo.') {

        //Récupération du message entier
        $dbLink = call_data_base();
        $FMess = "SELECT Message FROM Message WHERE Id_Discussion='$IdDiscussion'";
        $FullMessage = access_bd($dbLink,$FMess);
        $inser = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
        $inser.='"'.$FullMessage.$Participation.'",';
        $inser.='"'.$IdDiscussion.'")';
        access_bd($dbLink,$inser);
        $query = "DELETE FROM Message WHERE Id_Discussion='$IdDisc'";
        access_bd($dbLink,$query);
        //Affiche "la réponse a bien été fermée"
        echo 'La Discussion a été fermée';
    }

    //Ajout du message dans le message en cours
    $dbLink = call_data_base();
    $query = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
    $query.='"'.$Participation.'",';
    $query.='"'.$IdDisc.'",';
    $query.='"'.$pseudo.'")';
    access_bd($dbLink, $query);

    header("Location: ../controller/erreurController.php?erreur=VALIDATION_INSERT_MESSAGE");
}

if (isset($_POST['CloseDisc'])) {
    if (isset($_POST['CloseDisc'])) {
        $dbLink = call_data_base();
        $CloQuery = "UPDATE Discussion Set Closed='1' WHERE Id_Discussion='$IdDiscussion'";
        access_bd($dbLink, $CloQuery);
        echo '<!DOCTYPE html>
              <html lang="fr">
             <head>
             <title>Discussion fermée</title>
             </head>
             <body>
             <header> La discussion a bien été fermée </header><ul>
             </ul></body>' . PHP_EOL;
        $CloQuery = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
        $CloQuery .= '"' . 'Finito!' . '",';
        $CloQuery .= '"' . $IdDiscussion . '")';
        access_bd($dbLink, $CloQuery);
    }
}