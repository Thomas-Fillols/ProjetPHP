<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de MDP</title>
</head>
<body>


<!---------------------------------------------------------------->
<!---------formulaire de changement de mot de passe--------------->

<form action="checkReinitialisationMDP.php" method="post">
    <p>Entrez votre mail :</p>
    <input type="text" name="email"/><br/>
    <p>Entrez votre nouveau mot de passe :</p>
    <input type="password" name="mdp"/><br/>

    <input type="submit" name="action" value="connection">
</form>

</body>
</html>