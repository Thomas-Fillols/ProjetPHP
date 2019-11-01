<?php
include "variable.inc.php";

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

