<?php

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {       // On teste pour voir si nos variables ont bien été enregistrées

    $query="SELECT pseudo,email,role FROM utilisateur WHERE pseudo = '$pseudo'";

    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));

    if ($dbRow['role'] == 0){
        $role = 'Membre';
    }else if($dbRow['role'] == 1){
        $role = 'Super-administrateur';
    }else {
        $query="UPDATE utilisateur SET role=0 WHERE pseudo = '$pseudo'";
        access_bd($dbLink,$query);
    }
}
?>