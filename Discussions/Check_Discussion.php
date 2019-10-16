<?php
$query="SELECT Ndiscus FROM Discussion WHERE Ndiscus>=Ndiscus";
if(!($dbResult=mysqli_query($dbLink, $query))){
    echo'Erreur de requête<br/>';
    //Affiche le type d'erreur.
    echo'Erreur:'.mysqli_error($dbLink).'<br/>';
    //Affiche la requête envoyée.
    echo'Requête:'.$query.'<br/>';
    exit();
}
$dbRow=mysqli_fetch_assoc($dbResult);
if ($Close == 'Close Discussion') {
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
    $query .= '"' . ($dbRow['Ndiscus']+1) . '",';
    $query .= '"' . 'Fin' . '")';
    if ($Close =! $_POST['Close discussion'])
        echo '<br/><strong>Bouton non géré !</strong>';
}