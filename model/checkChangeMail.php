<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    session_start();

    $dbLink = call_data_base();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $query="SELECT email FROM utilisateur WHERE email ='$email' ";
        $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

        if ($dbRow['email'] == NULL){
            $query = "UPDATE utilisateur SET email ='$email' WHERE pseudo = '$pseudo'";
            access_bd($dbLink, $query);
            $_SESSION['email'] = $email;

            header('Location: ../controller/myprofilController.php');
        }else{
            header('Location: ../controller/erreurController.php?erreur=MAIL_EXIST');
        }
    }