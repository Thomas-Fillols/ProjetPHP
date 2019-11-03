<?php

    session_start();

    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['login'])){

        // Remplit les variables pour permettre l'affichage
        $estConnecte = 'style="display: none;"';
        $newDiscussion = "<a id=\"button_new_discussion\" href=\"../controller/DiscussionController.php\">nouvelle discussion</a>";

        // Récupère le role de l'utilisateur
        $connect = $dbLink->query("SELECT role FROM utilisateur WHERE pseudo='$pseudo'");
        $testRole = $connect->fetch();

        // Vérifie si l'utilisateur est un admin
        if ($testRole['role'] == 1){

            // Affiche un formulaire spécial pour les admins permettant de modifier la pagination
            $adminFormulairePagination = ("<form action=\"../controller/indexController.php\" method=\"post\">
                <label>Nombre de discussion : </label>
                <input type=\"number\" name=\"nombre\">
                <input type=\"submit\" name=\"action\" value=\"Modifier\">
            </form>");

            // Vérifie le POST du formulaire
            if (isset($_POST['nombre'])){
                // Vérifie si le POST est un valuer numerique
                if (!is_numeric($_POST['nombre'])){
                    header('Location: ../controller/erreurController.php?erreur=NO_NUMERIC');
                }else{
                    // Vérifie si le nombre est égal ou inferieur à 0
                    if ($_POST['nombre'] <= 0){
                        // Set la pagination à 2
                        $nombre = 2;
                    }else{
                        // Set la pagination à la valeur rentré
                        $nombre = $_POST['nombre'];
                    }
                    // Rajoute la pagination à la base de données
                    $connect = $dbLink->prepare("UPDATE Pagination SET pagination='$nombre'");
                    $connect->execute();
                    $testRole = $connect->fetch();
                }
            }
        }
    }else{
        $nonConnecte = 'style="display: none;"';
    }

    // Récupération du nombre d'élément à afficher par pagination
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
    $discussions = $dbLink->query('SELECT NomDiscussion,Id_Discussion FROM Discussion LIMIT '.$depart.','.$discussionsParPage);

?>