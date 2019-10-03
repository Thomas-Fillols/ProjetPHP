<?php
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));


    $utilisateur = $_POST['identifiant'];
    $mdp = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    echo "test<br/>";

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

