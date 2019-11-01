<?php
session_start();
if (isset($_SESSION['login'])){
    $estConnecte = 'style="display: none;"';
    $connect = $dbLink->query("SELECT role FROM utilisateur WHERE pseudo='$pseudo'");
    $testRole = $connect->fetch();
    if ($testRole['role'] == 1){
        $adminFormulairePagination = ("<form action=\"../controller/indexController.php\" method=\"post\">
                <label>Nombre de discussion : </label>
                <input type=\"number\" name=\"nombre\">
                <input type=\"submit\" name=\"action\" value=\"Modifier\">
            </form>");
        if (isset($_POST['nombre'])){
            if (!is_numeric($_POST['nombre'])){
                header('Location: ../controller/erreurController.php?erreur=NO_NUMERIC');
            }else{
                if ($_POST['nombre'] <= 0){
                    $nombre = 2;
                }else{
                    $nombre = $_POST['nombre'];
                }
                $connect = $dbLink->query("UPDATE Pagination SET pagination='$nombre'");
                $testRole = $connect->fetch();
            }
        }
    }
}else{
    $nonConnecte = 'style="display: none;"';
}
// Récupération d nombre d'élément à afficher par pagination
$discussionsParPageReq = $dbLink->query('SELECT pagination FROM Pagination');
$discussionsParPageI = $discussionsParPageReq->fetch();
$discussionsParPage = $discussionsParPageI['pagination'];
// Compte le nombre de pages totales
$pagesTotales = ceil($discussionsTotales/$discussionsParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}
$depart = ($pageCourante-1)*$discussionsParPage;
$discussions = $dbLink->query('SELECT pseudo,email FROM utilisateur LIMIT '.$depart.','.$discussionsParPage);


?>