<?php

    include ("../include/function.inc.php");
    $dbLink = call_data_base();

    if(isset($_POST['identifiant'])){
        $utilisateur = $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp = md5($_POST['mdp']);
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    #Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
    $role = '0';

    $query='INSERT INTO utilisateur(pseudo,password,email,role)VALUES(';
    $query.='"'.$utilisateur.'",';
    $query.='"'.$mdp.'",';
    $query.='"'.$email.'",';
    $query.='"'.$role.'")';

    access_bd($dbLink,$query);

