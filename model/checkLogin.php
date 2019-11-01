<?php
    require '../toolclass/variable.inc.php';

    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    if(isset($_POST['mdp'])){
        $mdp= md5($_POST['mdp']);
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

    $dbRowReq = $dbLink->query("SELECT pseudo,password,email FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'");
    $dbRow=$dbRowReq->fetch();

    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {
        session_start();

        $_SESSION['login']='true';
        $_SESSION['pseudo']=$utilisateur;
        $_SESSION['password']=$mdp;
        $_SESSION['email']=$dbRow['email'];

        header("Location: ../controller/myprofilController.php");

    } else {
        header('Location: ../controller/erreurController.php?erreur=PSEUDO_MDP_FAUX');
    }