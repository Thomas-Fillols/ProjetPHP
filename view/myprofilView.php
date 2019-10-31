<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mickaël Maurer">

    <title>FreeNote</title>
    <link rel="icon" type="image/x-icon" href="../public/images/favicon.ico">

    <link rel="stylesheet"  type="text/css"   href="../public/css/reset.css">
    <link id="pagestyle"  rel="stylesheet"  type="text/css" href="../public/css/profil.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
<div class="page">
    <header id="menu">
        <nav>
            <ul>
                <li> <a class="left" href="../controller/indexController.php">FreeNote</a> </li>

                <li> <a id="a_profil" class="right" href="../controller/myprofilController.php">profil</a> </li>
                <li> <a id="a_déconnexion" class="right" href="../model/logout.php">déconnexion</a> </li>
            </ul>
        </nav>
    </header>

    <section id="sec_profil">
        <h2>Mon profil</h2>
        <div id="profil">
            <ul>
                <li><label>Identifiant : <?php echo $pseudo; ?></label></li>
                <li><label>E-mail : <?php echo $email; ?></label></li>
                <li><label>Modifier :
                    <a href="../controller/changeMailController.php">E-mail</a>
                    /
                    <a href="../controller/reinitialiserMDPController.php">Mot de passe</a>
                </label>
                </li>
                <li><label>Rôle : <?php echo $role; ?></label></li>
                <?php echo $modifUtilisateur; ?>
            </ul>
        </div>
    </section>
</div>
</body>
</html>
