<?php
include "../include/function.inc.php";

function CloseDiscussion () {
    $query="SELECT Ndiscus FROM Discussion WHERE Ndiscus>=Ndiscus";
    $dbLink=call_data_base();
    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));
    echo '<!DOCTYPE html> 
              <html lang="fr">
              <head>
              <title>Discussion fermée</title>
              </head>
              <body>
              <header> La discussion a bien été fermée </header>
              <ul>
              </ul></body>' . PHP_EOL;
    $query = 'INSERT INTO Discussion(NDiscus, Participation)VALUES(';
    $query .= '"' . ($dbRow['Ndiscus'] + 1) . '",';
    $query .= '"' . 'Fin' . '")';
    if ($Close = !$_POST['Close discussion'])
        echo '<br/><strong>Bouton non géré !</strong>';

}