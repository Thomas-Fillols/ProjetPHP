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
    <link id="pagestyle"  rel="stylesheet"  type="text/css" href="../public/css/error.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
<div class="page">
    <section id="sec_error">
        <h2><?php echo $messageTitre; ?></h2>

        <div id="error">
            <ul>
                <li><label><?php echo $messageErreur; ?></label></li>
                <li><a href="../controller/indexController.php">Retour à l'accueil</a></li>
            </ul>
        </div>

    </section>
</div>
</body>
</html>