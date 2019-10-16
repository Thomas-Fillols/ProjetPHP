<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

<form action="checkSign_up.php" method="post">

    <input type="text" name="identifiant"/>Nom ou Pseudo<br/><br/>

    <input type="text" name="email">E-mail<br/><br/>

    <input type="password" name="mdp">Mot de passe<br/>
    <input type="password" name="mdpverif">Verification de mot de passe<br/><br/>

    <input type="checkbox" name="condition" value="ok">Condition d'utilisation<br/>

    <input type="submit" name="action" value="s'inscrire">
</form>

</body>
</html>
