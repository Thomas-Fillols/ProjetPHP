<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    if(isset($_POST['identifiant'])) {
        $utilisateur = $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if(isset($_POST['mdp'])){
        $mdp = $_POST['mdp'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=MAIL_VALIDATION_ERROR');
    }

    if(isset($_POST['mdpverif'])){
        $mdpverif = $_POST['mdpverif'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if(isset($_POST['condition'])) {
        $checkbox = $_POST['condition'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    $dbRowReq = $dbLink->query("SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'");
    $dbRox = $dbRowReq->fetch();

    if ($dbRow['pseudo'] == NULL){
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email ='$email'");
        $dbRox = $dbRowReq->fetch();
        if ($dbRow['email'] == NULL){
            if($mdp == $mdpverif){
                if($checkbox == 'ok'){
                    $query='INSERT INTO utilisateur(pseudo,password,email,role)VALUES(';
                    $query.='"'.$utilisateur.'",';
                    $query.='"'.md5($mdp).'",';
                    $query.='"'.$email.'",';
                    $query.='"'.$role.'")';

                    $dbRowReq = $dbLink->query($query);
                    $dbRowReq->fetch();

                    header("Location: ../controller/erreurController.php?erreur=VALIDATION_INSCRIPTION");
                }else{
                    header('Location: ../controller/erreurController.php?erreur=CONDITION_UTILISATION');
                }
            }else{
                header('Location: ../controller/erreurController.php?erreur=VERIF_MDP_FAUX');
            }
        }else{
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=NAME_EXIST');
    }

