<?php
    require '../toolclass/function.inc.php';
    require '../toolclass/variable.inc.php';

    $dbLink = call_data_base();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $query="SELECT email FROM utilisateur WHERE email = '$email'";

    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['email'] == $email) {

        $nouveauMdp = rand(100000,999999);
        $nouveauMdpencode = md5($nouveauMdp);

        $query="UPDATE utilisateur SET utilisateur.password ='$nouveauMdpencode' WHERE email = '$email'";

        access_bd($dbLink,$query);

        $message = 'Veuillez rentrez votre nouveau mot de passe : ' . $nouveauMdp . PHP_EOL;
        mail($email,$subject,$message);

        require '../controller/loginController.php';

    } else {
        echo 'Erreur, mauvais E-mail';
        require '../controller/reinitialiserMDPWithMailController.php';
    }
?>