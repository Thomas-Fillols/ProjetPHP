<?php

session_start();

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {

    // On teste pour voir si nos variables ont bien été enregistrées


    echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['password'].'.';
    echo '<br />';

    // On affiche un lien pour fermer notre session
    echo '<a href="identification/logout.php">Déconnection</a>';
}
else {
    echo 'Vous n\'êtes pas connecté.';
}
?>