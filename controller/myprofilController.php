<?php
    include '../include/function.inc.php';
    include '../include/variable.inc.php';

    session_start();

    $dbLink = call_data_base();

    require '../model/checkMyprofil.php';

    require '../view/myprofilView.php';