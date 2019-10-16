<?php

session_start();
include ("include/function.inc.php");
include ("include/variable.inc.php");

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {           // On teste pour voir si nos variables ont bien été enregistrées

    $dbLink = call_data_base();

    $query="SELECT pseudo,email,role FROM utilisateur WHERE pseudo = '$pseudo'";

    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['role'] == 0){
        $role = 'Membre';
    }else if($dbRow['role'] == 1){
        $role = 'Super-administrateur';
    }else {
        $query="UPDATE utilisateur SET role=0 WHERE pseudo = '$pseudo'";
        access_bd($dbLink,$query);
    }

    echo 'Votre login est '.$pseudo.'.';
    echo '<br />';
    echo 'Votre login est '.$password.'.';
    echo '<br />';
    echo '<a href="identification/reinitialiserMDP.php">Changer de mot de passe</a><br/>';
    echo 'Votre E-mail est : '.$dbRow['email'];
    echo '<br />';
    echo '<a href="identification/changeMail.php">Changer de mail</a>';
    echo '<br />';
    echo 'Votre rôle est : '.$role;
    echo '<br />';
    echo '<br />';

    // On affiche un lien pour fermer notre session
    echo '<a href="identification/logout.php">Déconnection</a>';
}
else {
    echo 'Vous n\'êtes pas connecté.';
}
?>