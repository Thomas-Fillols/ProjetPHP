<?php
    session_start();

    include("../toolclass/function.inc.php");
    include("../toolclass/variable.inc.php");

    $dbLink = call_data_base();

    require '../view/changeMailView.php';