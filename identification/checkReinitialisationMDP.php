<?php
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    $subject = 'Réinitialisation de mot de passe';

    $query="SELECT email FROM utilisateur WHERE email = '$email'";

    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }


    $dbRow=mysqli_fetch_assoc($dbResult);

    if ($dbRow['email'] == $email) {

        $nouveauMdp = md5(rand(100000,999999));

        $query="UPDATE utilisateur SET utilisateur.password ='$nouveauMdp' WHERE email = '$email'";

        if(!($dbResult=mysqli_query($dbLink, $query))){
            echo'Erreur de requête<br/>';
            //Affiche le type d'erreur.
            echo'Erreur:'.mysqli_error($dbLink).'<br/>';
            //Affiche la requête envoyée.
            echo'Requête:'.$query.'<br/>';
            exit();
        }

        $date = getdate();
        $message = 'Veuillez rentrez votre nouveau mot de passe : ' . $nouveauMdp . PHP_EOL;
        mail($email,$subject,$message);

    } else {
        echo 'Erreur, mauvais E-mail';
    }
