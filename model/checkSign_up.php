<?php

    if(isset($_POST['identifiant'])){
        $utilisateur = $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp = $_POST['mdp'];
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
        if($checkbox == 'ok'){
            $query='INSERT INTO utilisateur(pseudo,password,email,role)VALUES(';
            $query.='"'.$utilisateur.'",';
            $query.='"'.md5($mdp).'",';
            $query.='"'.$email.'",';
            $query.='"'.$role.'")';

            access_bd($dbLink,$query);
        }else{
            echo 'Vous n\'avez pas validé les conditions d\'utilisation.';
        }
    }else{
        echo 'La vérification de mot de passe est fausse.' ;
    }