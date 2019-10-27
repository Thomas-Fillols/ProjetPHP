<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    session_start();

    verif_connect_user("ERREUR_CONNECTION");

    require '../model/checkMyprofil.php';

    require '../view/myprofilView.php';