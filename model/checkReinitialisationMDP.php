<?php
    session_start();

    $dbLink = call_data_base();

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }

    //$pseudo = $_SESSION['pseudo'];
    var_dump($pseudo);

    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo ='$pseudo'";

    var_dump($query);

    access_bd($dbLink,$query);