<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    session_start();

    $dbLink = call_data_base();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $query="UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'";

    access_bd($dbLink,$query);

    $_SESSION['email'] = $email;

    require '../controller/myprofilController.php';