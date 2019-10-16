<?php

    session_start();

    include ("../include/function.inc.php");
    include ("../include/variable.inc.php");

    $dbLink = call_data_base();

    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp= md5($_POST['mdp']);
    }

    $query="SELECT pseudo,password FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'";

    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {

        $_SESSION['login']='true';
        $_SESSION['pseudo']=$utilisateur;
        $_SESSION['password']=$mdp;

        header('Location: ../myprofil.php');

    } else {
        echo 'Faux';
    }