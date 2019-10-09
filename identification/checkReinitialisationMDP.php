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

    $dbRow=mysqli_fetch_assoc($dbResult);

    if ($dbRow['email'] == $email) {

        $nouveauMDP = random_bytes(8);

        $query="INSERT INTO utilisateur(email, password) WHERE email = '$email' VALUES(";
        $query.='"'.$email.'",';
        $query.='"'.$nouveauMDP.'")';

        $date = getdate();
        $message = 'Voici votre mot de passe :' . $nouveauMDP . PHP_EOL;
        mail($email,$subject,$message);
    } else {
        header('Location:page2.php');
    }
