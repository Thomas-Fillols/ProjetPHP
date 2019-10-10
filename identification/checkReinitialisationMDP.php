<?php

    session_start();

    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }

    $pseudo = $_SESSION['pseudo'];

    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo = '$pseudo'";

    if(!($dbResult=mysqli_query($dbLink, $query))) {
        echo 'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo 'Erreur:' . mysqli_error($dbLink) . '<br/>';
        //Affiche la requête envoyée.
        echo 'Requête:' . $query . '<br/>';
        exit();
    }

    header('Location:login.php');