<?php

    echo 'Votre login est '.$pseudo.'.';
    echo '<br />';
    echo 'Votre login est '.$password.'.';
    echo '<br />';
    echo '<a href="../controller/reinitialiserMDPController.php">Changer de mot de passe</a><br/>';
    echo 'Votre E-mail est : '.$email.'.';
    echo '<br />';
    echo '<a href="../controller/changeMailController.php">Changer de mail</a>';
    echo '<br />';
    echo 'Votre rôle est : '.$role;
    echo '<br />';
    echo '<br />';

// On affiche un lien pour fermer notre session
    echo '<a href="../model/logout.php">Déconnection</a>';