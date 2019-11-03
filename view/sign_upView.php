<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mickaël Maurer">

    <title>FreeNote</title>
    <link rel="icon" type="image/x-icon" href="../public/images/favicon.ico">

    <link rel="stylesheet"  type="text/css"   href="../public/css/reset.css">
    <link id="pagestyle"  rel="stylesheet"  type="text/css" href="../public/css/form.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
<div class="page">
    <header id="menu">
        <nav>
            <ul>
                <li> <a class="left" href="../controller/indexController.php">FreeNote</a> </li>

                <li> <a id="a_inscription" class="right" href="../controller/sign_upController.php">inscription</a> </li>
                <li> <a id="a_connexion" class="right" href="../controller/loginController.php">connexion</a> </li>
            </ul>
        </nav>
    </header>

    <section id="sec_form">
        <h2>Créer votre compte</h2>

        <form action="../model/checkSign_up.php" method="post">
            <div id="form">
                <input type="text" name="identifiant" placeholder="Identifiant" pattern="^[a-zA-Z0-9]{3,20}$" required title="Minimum 3 caractères et maximum 20 caractères"/>
                <input type="text" name="email" placeholder="email@domain.com" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" required title="Veuillez rentrer un mail valide">
                <input type="password" name="mdp" placeholder="Mot de passe" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,40}$" required title="Votre mot de passe doit faire 8 caractères et doit contenir au moins 1 chiffre et 1 majuscule">
                <input type="password" name="mdpverif" placeholder="Vérification" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,40}$" required title="Votre mot de passe doit faire 8 caractères et doit contenir au moins 1 chiffre et 1 majuscule">
                <input type="checkbox" name="condition" value="ok" required><a target="_blank" href="#">Conditions</a>
            </div>
            <input type="submit" name="action" value="s'inscrire">
        </form>

    </section>
</div>
</body>
</html>