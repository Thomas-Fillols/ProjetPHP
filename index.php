<?php
    try{
        header("Location:controller/indexController.php");

    }catch(Exception $e){

        die ('Erreur : '.$e->getMessage());

    }
