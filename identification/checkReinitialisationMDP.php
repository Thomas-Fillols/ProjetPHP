<?php

    session_start();

    include ("../include/function.inc.php");
    include ("../include/variable.inc.php");
    $dbLink = call_data_base();

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }

    $pseudo = $_SESSION['pseudo'];

    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo = '$pseudo'";

    access_bd($dbLink,$query);

    header('Location:login.php');