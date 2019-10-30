<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    session_start();

    if(isset($_POST['MDP'])) {
        $MDP = md5($_POST['MDP']);
        $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET utilisateur.password ='$MDP' WHERE pseudo ='$pseudo'");
        $dbRowReq->fetch();
        header ("Location: ../controller/loginController.php");

    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }

