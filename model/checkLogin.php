<?php
    require '../toolclass/variable.inc.php';

    // Vérifie si l'identifiant a été rentrer
    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Vérifie si le mot de passe a été rentrer
    if(isset($_POST['mdp'])){
        $mdp= md5($_POST['mdp']);
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    // Récupère toutes les infos de l'utilisateur
    $dbRowReq = $dbLink->prepare("SELECT pseudo,password,email FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'");
    $dbRowReq->execute();
    $dbRow=$dbRowReq->fetch();

    // Vérifie si le pseudo et le mot passe correspondent à un utilisateur
    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {
        session_start();

        // Rentre toutes les données de l'utilisatue dans les variables $_SESSION
        $_SESSION['login']='true';
        $_SESSION['pseudo']=$utilisateur;
        $_SESSION['password']=$mdp;
        $_SESSION['email']=$dbRow['email'];

        header("Location: ../controller/myprofilController.php");

    } else {
        header('Location: ../controller/erreurController.php?erreur=PSEUDO_MDP_FAUX');
    }