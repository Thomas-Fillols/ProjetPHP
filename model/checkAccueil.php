<?php
    session_start();

    if (isset($_SESSION['login'])){
        $estConnecte = 'style="display: none;"';
        $connect = $dbLink->query("SELECT role FROM utilisateur WHERE pseudo='$pseudo'");
        $testRole = $connect->fetch();
        if ($testRole['role'] == 1){
            $adminConnecte = '';
        }
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