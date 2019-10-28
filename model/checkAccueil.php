<?php
    $estConnecte = '';
    $nonConnecte = '';

    session_start();

    if (isset($_SESSION['login'])){
        $estConnecte = 'style="display: none;"';
    }else{
        $nonConnecte = 'style="display: none;"';
    }
