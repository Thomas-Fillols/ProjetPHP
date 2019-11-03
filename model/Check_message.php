<?php
require '../toolclass/variable.inc.php';

//Récupération des variables de POST
$Participation = $_POST['Participation'];
$CloseDisc = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscussion'];
$SubmitPart = $_POST['BPart'];

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

//Récupère le message en cours
$MessInPr = $dbLink->prepare('SELECT Message FROM Message WHERE Id_Discussion = ?');
$MessInPr->execute(array($IdDiscussion));
$DMessInPr = $MessInPr->fetchAll();

// Récupère le pseudo pour vérifier si l'utilisateur a déjà écrit un message ou non
$req = $dbLink->prepare("SELECT Pseudo FROM Message WHERE pseudo='$pseudo' AND Id_Discussion=? ");
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

while ($donnee = $req->fetch())
{
    ?>
    <p><strong><?php echo htmlspecialchars($donnee['Pseudo']); ?></strong></p>
    <p><?php echo nl2br(htmlspecialchars($donnee['Message'])); ?></p>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();

if (isset($_SESSION['login']) && $DClos['Closed'] == 0) {
    $estConnecte = 'style="display: none;"';
}else{
    $nonConnecte = 'style="display: none;"';
}

//Envoies de la participation dans le message participatif
if (isset($_POST['BPart']) && isset($_SESSION['login'])) {

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

    if ($donnees) {
        throw (new Exception('Vous avez déjà participé dans ce message'));
    }

    //Si on envoi "Yolo." le message se ferme.

    //Ajout du message dans le message en cours
    $ajout = 'INSERT INTO Message(Message, Id_Discussion, Pseudo)VALUES(';
    $ajout.='"'.$Participation.'",';
    $ajout.='"'.$IdDiscussion.'",';
    $ajout.='"'.$pseudo.'")';
    $query = $dbLink->prepare($ajout);
    $query->execute();
    $query->fetch();

    if ($Participation == 'Yolo.') {

        //Récupération du message entier
        $FMessCount = $dbLink->query("SELECT count(Message) FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $FullMessageCount = $FMessCount->fetch();
        $FMess = $dbLink->query("SELECT Message FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $FullMessage = $FMess->fetchAll(PDO::FETCH_COLUMN,'Message');
        for ($i = 0;$i<=$FullMessageCount[0];++$i) {
            $test .= ' ' . $FullMessage[$i];
        }
        $fullMessageParticipation = $test . $Participation;
        $inser = $dbLink->query("INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES('$fullMessageParticipation', '$IdDiscussion')");
        $inser->fetch();
        $query = $dbLink->query("DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'");
        $query->fetch();
        //Affiche "la réponse a bien été fermée"
        echo 'La Discussion a été fermée';
    }

    header("Location: ../controller/erreurController.php?erreur=VALIDATION_INSERT_MESSAGE");
}

if (isset($_POST['CloseDisc'])) {
    $CloseQuery = $dbLink->query("UPDATE Discussion Set Closed='1' WHERE Id_Discussion='$IdDiscussion'");
    $CloseQuery->fetch();
    $CloQueryReq = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
    $CloQueryReq .= '"' . 'La discussion est terminée !' . '",';
    $CloQueryReq .= '"' . $IdDiscussion . '")';
    $CloQuery = $dbLink->query($CloQueryReq);
    $CloQuery->fetch();
    $query = $dbLink->query("DELETE FROM Message WHERE Id_Discussion='$IdDiscussion'");
    $query->fetch();

    echo 'La discussion a bien été fermée';
}
