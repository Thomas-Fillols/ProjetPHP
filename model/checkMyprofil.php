<?php
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {// On teste pour voir si nos variables ont bien été enregistrées

        $dbRowReq = $dbLink->query("SELECT pseudo,email,role FROM utilisateur WHERE pseudo = '$pseudo'");
        $dbRow=$dbRowReq->fetch();

        if ($dbRow['role'] == 0){
            $role = 'Membre';
        }else if($dbRow['role'] == 1){
            $role = 'Super-administrateur';
        }else {
            $dbRowReq = $dbLink->query("UPDATE utilisateur SET role=0 WHERE pseudo = '$pseudo'");
            $dbRowReq->fetch();
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }
?>