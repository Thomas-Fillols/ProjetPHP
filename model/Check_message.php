<?php
require '../toolclass/variable.inc.php';

// Récupération des variables du formulaire message
$Participation = $_POST['Participation'];
$NomD = $_POST['NomDiscussion'];

//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);

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

// Récupère le message en cours
$MessInPr = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ?');
$MessInPr->execute(array($IdDiscussion));
$DMessInPr = $MessInPr->fetchAll();

// Récupère le pseudo pour vérifier si l'utilisateur a déjà écrit un message ou non
$req = $dbLink->prepare("SELECT Pseudo FROM Message WHERE pseudo='$pseudo' AND Id_Discussion= ? ");
$req->execute(array($_GET['Id_Discussion']));
$donnees = $req ->fetch();

$clos->closeCursor();
$dis->closeCursor(); //Libère le curseur pour la prochaine requête
$FMess->closeCursor();
$MessInPr->closeCursor();
$req->closeCursor();

// Récupération des messages
$req = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ? ORDER BY Id_Message');
$req->execute(array($_GET['Discussion']));

// Vérifie si la discussion est fermé
if ($DClos['Closed'] == 1){
    $Connect = 'style="display: none;"';
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['login'])) {
        $estConnecte = 'style="display: none;"';
    }else{
        $nonConnecte = 'style="display: none;"';
    }
}else{
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['login'])) {
        $estConnecte = 'style="display: none;"';
    }else{
        $nonConnecte = 'style="display: none;"';
    }
}

// Envoie de la participation dans le message participatif
if (isset($_POST['BPart']) && isset($_SESSION['login'])) {

    //Erreur s'il y a plus de deux mots
    if (sizeof($NbMots) > 2)
        header("Location: ../controller/erreurController.php?erreur=WORD_MAX");

    //Erreur s'il y a 0 caractère
    if (strlen($Participation) == 0)
        header("Location: ../controller/erreurController.php?erreur=WORD_0");

    //Erreur s'il y a trop de caractères
    if (strlen($Participation) > 50)
        header("Location: ../controller/erreurController.php?erreur=WORD_50");

    //Erreur si on a déjà participé au message
    //if ($donnees) {
    //    header("Location: ../controller/erreurController.php?erreur=ALWAYS_PARTICIPATION");
    //}

    //Ajout du message dans le message en cours
    $ajout = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
    $ajout.='"'.$Participation.'",';
    $ajout.='"'.$IdDiscussion.'",';
    $ajout.='"'.$pseudo.'")';
    $query = $dbLink->prepare($ajout);
    $query->execute();
    $query->fetch();

    //Si on envoie '.' le message se ferme.
    if ($Participation == '.') {

        $FMessCount = $dbLink->query("SELECT count(Message) FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $FullMessageCount = $FMessCount->fetch();
        $FMess = $dbLink->query("SELECT Message FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $FullMessage = $FMess->fetchAll(PDO::FETCH_COLUMN,'Message');

        // Ajoute dans $Message tout les mots déjà existant pour ce message
        for ($i = 0;$i<$FullMessageCount[0];++$i) {
            $Message .= ' ' . $FullMessage[$i];
        }

        // Concatène Les anciens mots du message et le nouveau précédemment rentré
        $fullMessageParticipation = $Message.$Participation;

        // Ajoute à la base de données le message et supprime le message du message en cours
        $inser = $dbLink->query("INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES('$fullMessageParticipation', '$IdDiscussion')");
        $inser->fetch();
        $query = $dbLink->query("DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $query->fetch();
    }

    header("Location: ../controller/erreurController.php?erreur=VALIDATION_INSERT_MESSAGE");
}

// Vérifie si un utilisateur a fermé la discussion
if (isset($_POST['CloseDisc'])) {
    //Précise à la base de données que la discussion est fermé
    $CloseQuery = $dbLink->query("UPDATE Discussion Set Closed='1' WHERE Id_Discussion='$IdDiscussion'");
    $CloseQuery->fetch();

    // Ajoute à la base de données le message
    $inser = $dbLink->query("INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES('$fullMessageParticipation', '$IdDiscussion')");
    $inser->fetch();

    //Envoie d'un message pour dire aux utilisateurs que la discussion est fermé
    $CloQueryReq = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
    $CloQueryReq .= '"' . 'La discussion est terminée !' . '",';
    $CloQueryReq .= '"' . $IdDiscussion . '")';
    $CloQuery = $dbLink->query($CloQueryReq);
    $CloQuery->fetch();

    //Supprime le message du message en cours
    $query = $dbLink->query("DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'");
    $query->fetch();

    header("Location: ../controller/erreurController.php?erreur=CLOSE_DISCUSSION");
}