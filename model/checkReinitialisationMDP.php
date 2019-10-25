<?php
    require ('../toolclass/function.inc.php');


    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }


    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo ='$pseudo'";

    access_bd($dbLink,$query);