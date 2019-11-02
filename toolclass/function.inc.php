<?php
include "../toolclass/variable.inc.php";

function call_data_base(){
    $dbLink=mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote','zawarudo')
    or die('Erreur de connexion au serveur:'.mysqli_connect_error());
    mysqli_select_db($dbLink,'freenote_sql')
    or die('Erreur dans la sélection de la base:'.mysqli_error($dbLink));
    return $dbLink;
}


function access_bd($dbLink,$query){
    if(!($dbResult=mysqli_query($dbLink, $query))) {
        echo 'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo 'Erreur:' . mysqli_error($dbLink) . '<br/>';
        //Affiche la requête envoyée.
        echo 'Requête:' . $query . '<br/>';
        exit();
    }
    return $dbResult;
}

function verif_connect_user($erreur){
    if (!isset($_SESSION['login'])){
        header('Location: ../view/erreur.php?erreur='.$erreur);
    }
}

function CloseDisc($IdDiscussion){
    if (isset($_POST['CloseDisc'])) {
        $dbLink = call_data_base();
        $CloQuery = "UPDATE Discussion Set Closed='1' WHERE Id_Discussion='$IdDiscussion'";
        access_bd($dbLink, $CloQuery);
        echo '<!DOCTYPE html>
              <html lang="fr">
             <head>
             <title>Discussion fermée</title>
             </head>
             <body>
             <header> La discussion a bien été fermée </header><ul>
             </ul></body>' . PHP_EOL;
        $CloQuery  = 'INSERT INTO FullMessage(FullMessage, Id_Discussion)VALUES(';
        $CloQuery .= '"' . 'Finito!' . '",';
        $CloQuery .= '"' . $IdDiscussion . '")';
        access_bd($dbLink, $CloQuery);
    }
}


