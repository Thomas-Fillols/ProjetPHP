<?php

require '../toolclass/variable.inc.php';

// Récupération des variables du formulaire
$CloseD = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscu'];

// Requête pour recupérer un nom dans la bd Discussion
$query = "SELECT Distinct NomDiscussion FROM Discussion WHERE NomDiscussion='$NomD'";
$dbRowReq = $dbLink->prepare($query);
$dbRowReq->execute();
$dbRow = $dbRowReq->fetch();

//Si le bouton NameDiscu correspond bien
if ($_POST['BNameD'] == 'ouvrir discussion') {
    // Vérifie que le nom n'existe pas, que le nom ne soit pas vide et qu'il respecte un certain pattern
    if ($dbRow['NomDiscussion'] == NULL && strlen($NomD) != 0 && preg_match("#^[a-zA-Z0-9_]{3,30}$#", $NomD)) {
        //On crée une nouvelle discussion
        $query = 'INSERT INTO Discussion(NomDiscussion) VALUES(';
        $query .= '"' . $NomD . '")';
        $dbRowReq = $dbLink->prepare($query);
        $dbRowReq->execute();
        $dbRowReq->fetch();

        header("Location: ../controller/erreurController.php?erreur=CREATE_DISCUSSION");

    }else{
        header("Location: ../controller/erreurController.php?erreur=NOT_CREATE_DISCUSSION");
    }
}