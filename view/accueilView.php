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

                <li> <a id="a_inscription" class="right" <?php echo $estConnecte; ?> href="../controller/sign_upController.php">inscription</a> </li>
                <li> <a id="a_profil" class="right" <?php echo $nonConnecte; ?> href="../controller/myprofilController.php">profil</a> </li>
                <li> <a id="a_déconnexion" class="right" <?php echo $nonConnecte; ?> href="../model/logout.php">déconnexion</a> </li>
                <li> <a id="a_connexion" class="right" <?php echo $estConnecte; ?> href="../controller/loginController.php">connexion</a> </li>
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
        <a id="button_new_discussion" href="#">nouvelle discussion</a>
        <?php
            while($element = $discussions->fetch()) { ?>
                <div class="bloc_discussion">
                    <a href="#"><?php echo $element['pseudo']; ?></a>
                </div>
            <?php
            }
        ?>

        <div class="bloc_button">
            <?php
                for($i=1;$i<=$pagesTotales;$i++) {
                    /*if($i == $pageCourante) {
                        echo $i.' ';
                    } else { ?>
                       <a id="button_switch_nb_bloc" href="../controller/indexController.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php }*/

                    if($i==1 || (($pageCourante-2)<$i && $i<($pageCourante+2)) || $i==$pagesTotales) {
                        if($i==$pagesTotales && $pageCourante<($pagesTotales-2)) {
                            echo '...';
                        }
                        if ($i == $pageCourante) {
                            echo $i;
                        }
                        else { ?>
                            <a class="button_switch_nb_bloc" href="../controller/indexController.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php }
                        if($i==1 && $pageCourante>3) {
                            echo '...';
                        }
                    }
                }
            ?>
            <form action="../controller/indexController.php" method="post" <?php echo $adminConnecte; ?>>
                <label>Nombre de discussion : </label>
                <input type="number" name="nombre">
                <input type="submit" name="action" value="Modifier">
            </form>
        </div>
    </section>
</div>
</body>
</html>