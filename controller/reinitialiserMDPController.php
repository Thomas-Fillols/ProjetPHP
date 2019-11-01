<?php

    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    verif_connect_user("ERREUR_CONNECTION");

    session_start();

    require '../view/reinitialiserMDPView.php';