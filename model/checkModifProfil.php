<?php
    require '../toolclass/variable.inc.php';

    if(isset($_POST['identifiant'])) {
        $utilisateur = $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
    }

    if(is_numeric($_POST['role'])){
        if(isset($_POST['role'])){
            $newRole = $_POST['role'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ROLE_VALIDATION_ERROR');//////////////////////////////////////////////////
    }

    $dbRowReq = $dbLink->query("SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'");
    $dbRox = $dbRowReq->fetch();

    if ($dbRow['pseudo'] == NULL){
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email ='$email'");
        $dbRox = $dbRowReq->fetch();
        if ($dbRow['email'] == NULL){
            $query="UPDATE utilisateur SET email='$email' , role='$newRole' WHERE pseudo='$utilisateur'";

            $dbRowReq = $dbLink->prepare($query);
            $dbRowReq->fetch();

            header("Location: ../controller/erreurController.php?erreur=VALIDATION_MODIF");////////////////////////////////////////
        }else{
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=NAME_EXIST');
    }