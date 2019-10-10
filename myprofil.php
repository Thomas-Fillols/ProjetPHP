<?php

session_start();

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {           // On teste pour voir si nos variables ont bien été enregistrées

    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));

    $pseudo = $_SESSION['pseudo'];

    $query="SELECT pseudo,email,role FROM utilisateur WHERE pseudo = '$pseudo'";

    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }

    $dbRow=mysqli_fetch_assoc($dbResult);

    if ($dbRow['role'] == 0){
        $role = 'Membre';
    }else{
        $role = 'Super-administrateur';
    }

    echo 'Votre login est '.$_SESSION['pseudo'].'.';
    echo '<br />';
    echo 'Votre E-mail est : '.$dbRow['email'];
    echo '<br />';
    echo 'Votre rôle est : '.$role;
    echo '<br />';


    echo '<a href="identification/reinitialiserMDP.php">Changer de mot de passe</a><br/>';

    // On affiche un lien pour fermer notre session
    echo '<a href="identification/logout.php">Déconnection</a>';
}
else {
    echo 'Vous n\'êtes pas connecté.';
}
?>