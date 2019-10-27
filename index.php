<?php
    try{
        require 'controller/indexController.php';

    }catch(Exception $e){

        die ('Erreur : '.$e->getMessage());

    }
