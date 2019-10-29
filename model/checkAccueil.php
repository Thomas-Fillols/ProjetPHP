<?php
$estConnecte = '';
$nonConnecte = '';

$pageCourante = 1;
$discussionsParPage = 2;

$dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');

$discussionsTotalesReq = $dbLink->query('SELECT * FROM utilisateur');
$discussionsTotales = $discussionsTotalesReq->rowCount();
$pagesTotales = ceil($discussionsTotales/$discussionsParPage);

session_start();

    if (isset($_SESSION['login'])){
        $estConnecte = 'style="display: none;"';
    }else{
        $nonConnecte = 'style="display: none;"';
    }

    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
        $_GET['page'] = intval($_GET['page']);
        $pageCourante = $_GET['page'];
    } else {
        $pageCourante = 1;
    }

    $depart = ($pageCourante-1)*$discussionsParPage;
    $discussions = $dbLink->query('SELECT pseudo,email FROM utilisateur LIMIT '.$depart.','.$discussionsParPage);

?>