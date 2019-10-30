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
                <li><span>Identifiant : <?php echo $pseudo; ?></span></li>
                <li><span>Email : <?php echo $email; ?></span></li>
                <li><span>Modifier :
                    <a href="../controller/changeMailController.php">email</a>

                    <a href="../controller/reinitialiserMDPController.php">mot de passe</a>
                </span>
                </li>
                <li> <span>Rôle : <?php echo $role; ?></span></li>
            </ul>
            <a href="../model/logout.php">Déconnexion</a>
        </div>

    </section>
</div>
</body>
</html>
