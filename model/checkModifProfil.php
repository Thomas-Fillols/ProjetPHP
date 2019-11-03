<?php
    require '../toolclass/variable.inc.php';

    // Vérifie si l'identifiant a été rentrer
    if(isset($_POST['identifiant'])) {
        $utilisateur = $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Vérifie si le mot de passe a été rentrer
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

    // Vérifie le role
    if(isset($_POST['role'])){
        $newRole = $_POST['role'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    $dbRowReq = $dbLink->query("SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'");
    $dbRow = $dbRowReq->fetch();

    // Vérifie si l'identifiant rentrer correspond à un utilisateur
    if ($dbRow['pseudo'] == $utilisateur){
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email ='$email'");
        $dbRow = $dbRowReq->fetch();
        // Vérifie si le mail n'existe pas
        if ($dbRow['email'] == NULL || $mailOK){

            // Rentre le mail dans la base de données
            $query="UPDATE utilisateur SET email='$email', role='$newRole' WHERE pseudo='$utilisateur'";
            $dbRowReq = $dbLink->prepare($query);
            $dbRowReq->execute();
            $dbRowReq->fetch();

            header("Location: ../controller/erreurController.php?erreur=VALIDATION_MODIF");
        }else {
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=NAME_NOT_EXIST');
    }