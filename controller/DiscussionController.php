<?php
    require '../toolclass/function.inc.php';

    session_start();

    verif_connect_user("ERREUR_CONNECTION");

    require '../model/Check_Discussion.php';

    require '../view/openDiscussionView.php';