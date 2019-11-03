<?php
    require '../toolclass/variable.inc.php';

    session_start();

    // Vérifie le mail récupéré
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $dbRowReq = $dbLink->prepare("SELECT email FROM utilisateur WHERE email ='$email' ");
        $dbRowReq->execute();
        $dbRow=$dbRowReq->fetch();

        //Vérifie si le mail rentrer est déjà attribué
        if ($dbRow['email'] == NULL){
            $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'");
            $dbRowReq->execute();
            $dbRowReq->fetch();
            $_SESSION['email'] = $email;

            header('Location: ../controller/indexController.php');
        }else{
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }