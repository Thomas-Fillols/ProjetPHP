<?php

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

        $date = getdate();
        $message = 'Veuillez rentrez votre nouveau mot de passe : ' . $nouveauMdp . PHP_EOL;
        mail($email,$subject,$message);

    } else {
        echo 'Erreur, mauvais E-mail';
    }
