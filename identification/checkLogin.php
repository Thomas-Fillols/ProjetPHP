<?php
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));


    $utilisateur= $_POST['identifiant'];
    $mdp= $_POST['mdp'];

    $query="SELECT pseudo,password FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'";

    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }

    $dbRow=mysqli_fetch_assoc($dbResult);

    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {

        session_start();

        $_SESSION['login']='true';
        $_SESSION['email']=$utilisateur;
        $_SESSION['password']=$mdp;

        header('Location: ../myprofil.php');

    } else {
        echo 'Faux';
    }