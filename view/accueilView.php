<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mickaël Maurer">
    <meta name="description" content="réseau social">
    <meta name="keywords" content="note, message, discussion">

    <title>FreeNote</title>
    <link rel="icon" type="image/x-icon" href="../public/images/favicon.ico">

    <link rel="stylesheet" type="text/css" href="../public/css/reset.css">
    <link id="pagestyle" rel="stylesheet" type="text/css" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
<div class="page">
    <header id="menu">
        <nav>
            <ul>
                <li> <a class="left" href="../controller/indexController.php">FreeNote</a> </li>

                <li> <a id="a_inscription" class="right" href="../controller/sign_upController.php">inscription</a> </li>
                <li> <a id="a_profil" class="right" style="display: none;" href="#">profil</a> </li>
                <li> <a id="a_déconnexion" class="right" style="display: none;" href="../model/logout.php">déconnexion</a> </li>
                <li> <a id="a_connexion" class="right" href="../controller/loginController.php">connexion</a> </li>
            </ul>
        </nav>
    </header>

    <section id="sec_description">
        <h2>description</h2>

        <div>
            <p>Réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant
                des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.</p>
        </div>
    </section>


    <section id="sec_discussion">
        <h2>discussions</h2>
        <div class="bloc_discussion">
            <div class="bloc_title">
                Titre de la discussion Titre de la discussion Titre de la discussion Titre de la discussion Titre de la discussion Titre de la discussion Titre de la discussion
            </div>

            <div class="bloc_state">
                <figure class="dot"></figure>
            </div>
        </div>

        <div class="bloc_discussion">
            <div class="bloc_title">
                Titre de la discussion
            </div>

            <div class="bloc_state">
                <figure class="dot"></figure>
            </div>
        </div>

        <div class="button">
            <button id="button_prev">précédent</button>
            <button id="button_next">suivant</button>
            <button id="button_switch_nb_bloc">2</button>
        </div>
    </section>
</div>
</body>
</html>