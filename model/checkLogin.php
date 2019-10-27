<?php
    require '../toolclass/function.inc.php';

    $dbLink = call_data_base();

    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp= md5($_POST['mdp']);
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
        echo 'Faux';
    }