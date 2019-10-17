<?php
    session_start();

    include ("../include/function.inc.php");
    include ("../include/variable.inc.php");

    $dbLink = call_data_base();

    require '../view/reinitialiserMDPView.php';