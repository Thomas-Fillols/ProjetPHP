<?php

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $pseudo = $_SESSION['pseudo'];

    $query="UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'";

    access_bd($dbLink,$query);

    header('Location:../myprofilController.php');