<?php
    require '../toolclass/variable.inc.php';

    session_start();

    // Verifie si le mot de passe a bien été rentré
    if(isset($_POST['MDP'])) {
        // Encode le mot de passe
        $MDP = md5($_POST['MDP']);
        // L'envoie dans la base de données
        $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo ='$pseudo'");
        $dbRowReq->execute();
        $dbRowReq->fetch();
        header ("Location: ../controller/loginController.php");

    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

