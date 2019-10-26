<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    session_start();

    $dbLink = call_data_base();

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }

    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo ='$pseudo'";

    access_bd($dbLink,$query);

    require '../controller/loginController.php';