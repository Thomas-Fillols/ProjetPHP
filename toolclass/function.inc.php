<?php

    function verif_connect_user($erreur){
        if (!isset($_SESSION['login'])){
            header('Location: ../controller/erreurController.php?erreur='.$erreur);
        }
    }