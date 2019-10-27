<?php
    require '../toolclass/variable.inc.php';
    require '../toolclass/function.inc.php';

    verif_connect_user("ERREUR_CONNECTION");

    session_start();

    require '../model/checkMyprofil.php';

    require '../view/myprofilView.php';