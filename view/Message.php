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

                <li> <a id="a_inscription" class="right" <?php echo $estConnecte; ?> href="../controller/sign_upController.php">inscription</a> </li>
                <li> <a id="a_profil" class="right" <?php echo $nonConnecte; ?> href="../controller/myprofilController.php">profil</a> </li>
                <li> <a id="a_déconnexion" class="right" <?php echo $nonConnecte; ?> href="../model/logout.php">déconnexion</a> </li>
                <li> <a id="a_connexion" class="right" <?php echo $estConnecte; ?> href="../controller/loginController.php">connexion</a> </li>
            </ul>
        </nav>
    </header>

    <section id="sec_form">
        <h2><?php echo htmlspecialchars($Ddis['NomDiscussion']); ?></h2>

        <div id="bloc_discu">
            <p id="old_mess">
                Dicsussion : <br>
                <?php
                foreach ($DFMess as $row => $values) {
                    echo nl2br(htmlspecialchars($values['FullMessage']));?><br>
                <?php }
                ?>
            </p>
            <p <?php echo $nonConnecte; ?>>
                Message en cours : <br>
                <?php
                foreach ($DMessInPr as $row => $values) {
                    echo nl2br(htmlspecialchars($values["Message"]));
                    echo ' ';
                }
                ?>
            </p>
        </div>
        <form action="../model/Check_message.php?Id_Discussion=<?php echo $IdDiscussion; ?>" method="post"<?php echo $nonConnecte; ?>>
            <div id="form">
                <label for="Participation"> Écrivez les mots souhaités ( 2 Maximum ) : </label>
                <input id="message" type="text" name="Participation" placeholder="Écrivez votre message" required title="Veuillez rentrer 1 ou 2 mots.">
            </div>

            <input id="CloseD" type="submit" name="CloseDisc" value="fermer discussion">
            <input id="BParticipation" type="Submit" name="BPart" value="envoyer">
        </form>

    </section>
</div>
</body>
</html>