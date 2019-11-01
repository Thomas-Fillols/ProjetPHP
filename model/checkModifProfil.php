<?php
    require '../toolclass/variable.inc.php';

    if(isset($_POST['identifiant'])) {
        $utilisateur = $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if(isset($_POST['email']) && $_POST['email'] != ''){
        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
            $email = $_POST['email'];
        }
    }else{
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE pseudo ='$utilisateur'");
        $dbRow = $dbRowReq->fetch();
        $email = $dbRow['email'];
        $mailOK = true;
    }

    if(isset($_POST['role'])){
        $newRole = $_POST['role'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    $dbRowReq = $dbLink->query("SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'");
    $dbRow = $dbRowReq->fetch();

    if ($dbRow['pseudo'] == $utilisateur){
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email ='$email'");
        $dbRow = $dbRowReq->fetch();
        if ($dbRow['email'] == NULL || $mailOK){
            $query="UPDATE utilisateur SET email='$email', role='$newRole' WHERE pseudo='$utilisateur'";

            $dbRowReq = $dbLink->query($query);
            $dbRowReq->fetch();

            header("Location: ../controller/erreurController.php?erreur=VALIDATION_MODIF");
        }else {
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=NAME_NOT_EXIST');
    }