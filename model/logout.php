<?php
    // On démarre la session
    session_start ();

    // On détruit les variables de notre session
    session_unset ();

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    // On détruit notre session
    session_destroy ();

    // On redirige le visiteur vers la page de login
    header("Location: ../controller/loginController.php");
?>