<?php
include "variable.inc.php";

function call_data_base()
{
    $dbLink = mysqli_connect('mysql-freenote.alwaysdata.net', 'freenote', 'zawarudo')
    or die('Erreur de connexion au serveur:' . mysqli_connect_error());

    mysqli_select_db($dbLink, 'freenote_sql')
    or die('Erreur dans la sélection de la base:' . mysqli_error($dbLink));
    return $dbLink;
}

//Fonction d'erreurs et d'accès à la BD
function access_bd($dbLink, $query)
{
    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo 'Erreur de requête<br/>';
        //Affiche le type d'erreur.
        echo 'Erreur:' . mysqli_error($dbLink) . '<br/>';
        //Affiche la requête envoyée.
        echo 'Requête:' . $query . '<br/>';
        exit();
    }
    return $dbResult;
}

//
function FindFullMess ()
{
    $FFullMess = 0 ;
        $FFullMess = "SELECT Ndiscus 
CASE
    WHEN D.Ndiscus = 0 THEN SET '$FFullMess'= D.Ndiscus
    WHEN D.Ndicus > 0 THEN  SET '$FFullMess'= D.(Ndiscus-1)
END AS QuantityText
FROM Discussion D
; ";
    return $FFullMess;
    var_dump($FFullMess);
}

//Fonction
function Fullmessage()
{
    $FFullMess = FindFullMess();
    $dbLink = call_data_base();
    $DBFMess = "SELECT D.FullMessage FROM Discussion D join Discussion Disc ON Disc.NumPart = D.NumPart WHERE D.Ndiscus='$FFullMess'";
    access_bd($dbLink, $DBFMess);
    return $FMess = $DBFMess . $_POST['Participation'];
}