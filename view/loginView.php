<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>


<!--------------------------------------------------->
<!---------formulaire d'identification--------------->

<form action="../model/checkLogin.php" method="post">
    <input type="text" name="identifiant"/>Nom ou Pseudo<br/>

    <input type="password" name="mdp">Mot de passe<br/>

    <input type="submit" name="action" value="connexion">
</form>
<div>
    <a href="../controller/reinitialiserMDPWithMailController.php" name="reinitialisationMDP">Mot de passe oublié ?</a>
</div>
</body>
</html>