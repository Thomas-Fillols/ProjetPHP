<?php
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));

    if(isset($_POST['identifiant'])){
        $utilisateur = $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp = $_POST['mdp'];
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

    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }

