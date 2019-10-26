<?php

    $dbLink = call_data_base();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $query="UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'";

    access_bd($dbLink,$query);

    header('Location:../myprofilController.php');