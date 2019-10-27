<?php
    require '../toolclass/variable.inc.php';
    require '../toolclass/function.inc.php';

    verif_connect_user();

    session_start();

    require '../model/checkMyprofil.php';

    require '../view/myprofilView.php';