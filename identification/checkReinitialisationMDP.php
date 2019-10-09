<?php
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
        or die('Erreur de connexion au serveur:'.mysqli_connect_error());

    mysqli_select_db($dbLink,'freenote_sql')
        or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));

    $email = $_POST['email'];
    $subject = 'Réinitialisation de mot de passe';

    $query="SELECT email FROM utilisateur where email = '$email'";

    if(!($dbResult=mysqli_query($dbLink, $query))){
        echo'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo'Erreur:'.mysqli_error($dbLink).'<br/>';
        //Affiche la requête envoyée.
        echo'Requête:'.$query.'<br/>';
        exit();
    }

    var_dump($query);

    $dbRow=mysqli_fetch_assoc($dbResult);

    if ($dbRow['email'] == $email) {

        //$nouveauMDP = random_bytes(8);
        $nouveauMDP= 'poiuytreza';


        $query="UPDATE utilisateur SET password ='$nouveauMDP' WHERE email = '$email'";

        if(!($dbResult=mysqli_query($dbLink, $query))){
            echo'Erreur de requête<br/>';
            //Affiche le type d'erreur.
            echo'Erreur:'.mysqli_error($dbLink).'<br/>';
            //Affiche la requête envoyée.
            echo'Requête:'.$query.'<br/>';
            exit();
        }

        $date = getdate();
        $message = 'Voici votre mot de passe :' . $nouveauMDP . PHP_EOL;
        mail($email,$subject,$message);

        header('Location:page2.php');
    } else {
        header('Location:page2.php');
    }
