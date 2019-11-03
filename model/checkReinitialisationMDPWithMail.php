<?php
    require '../toolclass/variable.inc.php';

    // Vérifie si le mail à bien été rentré
    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email = '$email'");
        $dbRow = $dbRowReq->fetch();

        // Vérifie si le mail existe
        if ($dbRow['email'] == $email) {

            // Génère un nouveau mot de passe
            $nouveauMdp = rand(100000,999999);
            $nouveauMdpencode = md5($nouveauMdp);

            $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET utilisateur.password ='$nouveauMdpencode' WHERE email = '$email'");
            $dbRowReq->execute();
            $dbRowReq->fetch();

            // Envoie un mail a l'utilisateur
            $message = 'Veuillez rentrez votre nouveau mot de passe : ' . $nouveauMdp . PHP_EOL;
            mail($email,$subject,$message);

            header("Location: ../controller/erreurController.php?erreur=NOUVEAU_MDP");

        } else {
            header("../controller/erreurController.php?erreur=MAIL_EXIST");
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

