<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    $dbLink = call_data_base();

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

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
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

    $query="SELECT pseudo FROM utilisateur WHERE pseudo ='$utilisateur'";
    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['pseudo'] == NULL){
        $query="SELECT email FROM utilisateur WHERE email ='$email'";
        $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));
        if ($dbRow['email'] == NULL){
            if($mdp == $mdpverif){
                if($checkbox == 'ok'){
                    $query='INSERT INTO utilisateur(pseudo,password,email,role)VALUES(';
                    $query.='"'.$utilisateur.'",';
                    $query.='"'.md5($mdp).'",';
                    $query.='"'.$email.'",';
                    $query.='"'.$role.'")';

                    access_bd($dbLink,$query);

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

