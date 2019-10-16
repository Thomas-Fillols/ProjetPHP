<?php

    include ("../include/function.inc.php");
    include ("../include/variable.inc.php");

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

    if(isset($_POST['mdpverif'])){
        $mdpverif = $_POST['mdpverif'];
    }

    if(isset($_POST['condition'])){
        $checkbox = $_POST['condition'];
    }

    if($mdp == $mdpverif){
        $query='INSERT INTO utilisateur(pseudo,password,email,role)VALUES(';
        $query.='"'.$utilisateur.'",';
        $query.='"'.$mdp.'",';
        $query.='"'.$email.'",';
        $query.='"'.$role.'")';

        access_bd($dbLink,$query);
    }else{
        echo 'La vérification de mot de passe est fausse' ;
    }