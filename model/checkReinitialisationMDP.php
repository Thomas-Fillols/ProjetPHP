<?php

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
    }

    $pseudo = $_SESSION['pseudo'];

    $query="UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo = '$pseudo'";

    access_bd($dbLink,$query);