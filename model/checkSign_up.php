<?php
    require '../toolclass/variable.inc.php';

    // Vérifie si l'utilisateur a été rentrer
    if(isset($_POST['identifiant'])) {
        if(preg_match("#^[a-zA-Z0-9_]{3,20}$#",$_POST['identifiant'])){
            $utilisateur = $_POST['identifiant'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=USER_VALIDATION_ERROR');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Vérifie si le mot de passe a été rentrer
    if(isset($_POST['mdp'])){
        // Vérifie le pattern
        if(preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,40}$#",$_POST['mdp'])){
            $mdp = $_POST['mdp'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=MDP_VALIDATION_ERROR');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Vérifie si le mail à bien été rentré
    // Vérifie le pattern
    if(preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=MAIL_VALIDATION_ERROR');
    }

    // Vérifie si le mot de passe verif a été rentrer
    if(isset($_POST['mdpverif'])){
        // Vérifie le pattern
        if(preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,40}$#",$_POST['mdpverif'])){
            $mdpverif = $_POST['mdpverif'];
        }else{
            header('Location: ../controller/erreurController.php?erreur=MDP_VALIDATION_ERROR');
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Valide les conditions d'utilisation
    if(isset($_POST['condition'])) {
        $checkbox = $_POST['condition'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    $dbRowReq = $dbLink->query("SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'");
    $dbRox = $dbRowReq->fetch();

    // Vérifie si le pseudo existe
    if ($dbRow['pseudo'] == NULL){
        $dbRowReq = $dbLink->query("SELECT email FROM utilisateur WHERE email ='$email'");
        $dbRox = $dbRowReq->fetch();
        // Vérifie si l'email existe
        if ($dbRow['email'] == NULL){
            // Vérifie si le mot de passe est bien le meme que la vérification
            if($mdp == $mdpverif){
                // Vérifie si les conditions sont bien acceptés
                if($checkbox == 'ok'){
                    $query='INSERT INTO utilisateur(pseudo,password,email,role) VALUES(';
                    $query.='"'.$utilisateur.'",';
                    $query.='"'.md5($mdp).'",';
                    $query.='"'.$email.'",';
                    $query.='"'.$role.'")';

                    $dbRowReq = $dbLink->prepare($query);
                    $dbRowReq->execute();
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

