<?php
//
//
////Connexion à la base de donnée
//try
//{
//    $dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');
//}
//catch(Exception $e)
//{
//    die('Erreur : '.$e->getMessage());
//}
//?>
<!--    <!DOCTYPE html>-->
<!--    <html>-->
<!--    <head>-->
<!--        <meta charset="utf-8" />-->
<!--        <title>Mon blog</title>-->
<!--        <link href="style.css" rel="stylesheet" />-->
<!--    </head>-->
<!---->
<!--<body>-->
<!--    <h1>Mon super blog !</h1>-->
<!--    <p>Derniers billets du blog :</p>-->
<!---->
<?php
//// Connexion à la base de données
//try
//{
//    $dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');
//}
//catch(Exception $e)
//{
//    die('Erreur : '.$e->getMessage());
//}
//
//
//// On récupère les 5 derniers billets
//$req = $dbLink->query('SELECT NomDiscussion, FullMessage, Id_Discussion FROM Discussion ORDER BY Id_Discussion DESC LIMIT 0, 5');
//
//while ($donnees = $req->fetch())
//{
//    ?>
<!--    <div>-->
<!--        <h3>-->
<!--            --><?php //echo htmlspecialchars($donnees['NomDiscussion']); ?>
<!--        </h3>-->
<!---->
<!--        <p>-->
<!--            --><?php
//            // On affiche le contenu du billet
//            echo nl2br(htmlspecialchars($donnees['FullMessage']));
//            ?>
<!--            <br />-->
<!--            <em><a href="../controller/MessageController.php?Id_Discussion=--><?php //echo $donnees['Id_Discussion']; ?><!--">Messages</a></em>-->
<!--        </p>-->
<!--    </div>-->
<!--    --><?php
//} // Fin de la boucle des billets
//$req->closeCursor();)