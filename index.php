<?php

require('toolclass/function.inc.php');

try{

    $bdLink = call_data_base();
    require ('controller/indexController.php');
    echo 'test';

}catch(Exception $e){

    die ('Erreur : '.$e->getMessage());

}
