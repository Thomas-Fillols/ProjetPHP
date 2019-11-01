<?php
    require '../toolclass/variable.inc.php';

    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email = '$email'");
        $dbRow = $dbRowReq->fetch();

        if ($dbRow['email'] == $email) {

            $nouveauMdp = rand(100000,999999);
            $nouveauMdpencode = md5($nouveauMdp);

            $dbRowReq = $dbLink->query("UPDATE utilisateur SET utilisateur.password ='$nouveauMdpencode' WHERE email = '$email'");
            $dbRowReq->fetch();

            $message = 'Veuillez rentrez votre nouveau mot de passe : ' . $nouveauMdp . PHP_EOL;
            mail($email,$subject,$message);

            header("Location: ../controller/erreurController.php?erreur=NOUVEAU_MDP");

        } else {
            header("../controller/erreurController.php?erreur=MAIL_EXIST");
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

