<?php
    require '../toolclass/variable.inc.php';

    session_start();


    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $dbRowReq = $dbLink->prepare("SELECT email FROM utilisateur WHERE email ='$email' ");
        $dbRow=$dbRowReq->fetch();

        if ($dbRow['email'] == NULL){
            $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'");
            $dbRowReq->fetch();
            $_SESSION['email'] = $email;

            header('Location: ../controller/myprofilController.php');
        }else{
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }