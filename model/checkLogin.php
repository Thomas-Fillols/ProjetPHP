<?php

    $dbLink = call_data_base();

    if(isset($_POST['identifiant'])){
        $utilisateur= $_POST['identifiant'];
    }

    if(isset($_POST['mdp'])){
        $mdp= $_POST['mdp'];
    }

    $query="SELECT pseudo,password FROM utilisateur where pseudo = '$utilisateur' and password = '$mdp'";

    $dbRow=mysqli_fetch_assoc(access_bd($dbLink,$query));
    var_dump($dbRow);
    var_dump($dbRow['pseudo']);
    var_dump($dbRow['password']);
    if ($dbRow['pseudo'] == $utilisateur && $dbRow['password'] == $mdp) {

        $_SESSION['login']='true';
        $_SESSION['pseudo']=$utilisateur;
        $_SESSION['password']=md5($mdp);

        require ('../controller/myprofilController.php');

    } else {
        echo 'Faux';
    }