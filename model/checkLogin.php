<?php
    require '../toolclass/function.inc.php';

    $dbLink = call_data_base();

    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }else{
        header('Location: ../view/erreur.php?erreur=ERROR_ISSET');
    }

    if(isset($_POST['mdp'])){
        $mdp= md5($_POST['mdp']);
    }else{
        header('Location: ../view/erreur.php?erreur=ERROR_ISSET');
    }

    $query="SELECT pseudo,password,email FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'";
    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {
        session_start();

        $_SESSION['login']='true';
        $_SESSION['pseudo']=$utilisateur;
        $_SESSION['password']=$mdp;
        $_SESSION['email']=$dbRow['email'];

        header("Location: ../controller/myprofilController.php");

    } else {
        header('Location: ../view/erreur.php?erreur=PSEUDO_MDP_FAUX');
    }