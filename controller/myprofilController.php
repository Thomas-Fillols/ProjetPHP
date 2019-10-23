<?php
    include '../toolclass/function.inc.php';
    include '../toolclass/variable.inc.php';

    session_start();

    $dbLink = call_data_base();

    require 'model/checkMyprofil.php';

    require 'view/myprofilView.php';