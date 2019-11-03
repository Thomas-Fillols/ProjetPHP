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

                <li><a id="a_profil" class="right" href="../controller/myprofilController.php">profil</a></li>
                <li><a id="a_déconnexion" class="right" href="../model/logout.php">déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <section id="sec_form">
        <h2>Créer une discussion</h2>

        <form action="../model/Check_Discussion.php" method="post">
            <div id="form">
                <input type="Text" name="NomDiscu" id="NameDiscussion" placeholder="Nom de la discussion" pattern="^[a-zA-Z0-9_]{3,30}$" required title="Veuillez rentrer 1 seul mot. Le mot doit faire entre 3 et 30 caractères.">
            </div>
            <input id="NameDiscu" type="Submit" name="BNameD" value="ouvrir discussion">
        </form>

    </section>
</div>
</body>
</html>