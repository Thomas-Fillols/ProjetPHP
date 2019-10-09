<?php

session_start();

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

    // On teste pour voir si nos variables ont bien été enregistrées
    echo '<head>';
    echo '<title>Page de notre section membre</title>';
    echo '</head>';

    echo '<body>';
    echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
    echo '<br />';

    // On affiche un lien pour fermer notre session
    echo '<a href="identification/logout.php">Déconnection</a>';
}
else {
    echo 'Vous êtes déconnectez.';
}
?>