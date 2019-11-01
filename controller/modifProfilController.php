<?php
    require '../toolclass/function.inc.php';

    session_start();

    verif_connect_user("ERREUR_CONNECTION");

    require '../view/modifProfilView.php';