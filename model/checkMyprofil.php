<?php
    // On teste pour voir si nos variables ont bien été enregistrées
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {

        $dbRowReq = $dbLink->query("SELECT pseudo,email,role FROM utilisateur WHERE pseudo = '$pseudo'");
        $dbRow=$dbRowReq->fetch();

        // Vérifie si l'utilisateur est un membre
        if ($dbRow['role'] == 0){
            $role = 'Membre';
        // Vérifie si l'utilisateur est un admin
        }else if($dbRow['role'] == 1){
            $role = 'Super-administrateur';
            $modifUtilisateur = "<li><label>Action admin : <a href=\"../controller/modifProfilController.php\">Modifier un utilisateur</a></label></li>";
        // Sinon set l'utilisateur au role de membre
        }else {
            $dbRowReq = $dbLink->prepare("UPDATE utilisateur SET role=0 WHERE pseudo = '$pseudo'");
            $dbRowReq->execute();
            $dbRowReq->fetch();
        }
    }else{
        header('Location: ../controller/erreurController.php?erreur=ERROR_ISSET');
    }
?>