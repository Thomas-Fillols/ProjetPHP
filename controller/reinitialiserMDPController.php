<?php
    require '../toolclass/function.inc.php';

    session_start();

    verif_connect_user();

    require '../view/reinitialiserMDPView.php';
