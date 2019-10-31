<?php
    include "../model/Check_message.php"
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Discussion</title>
</head>
<body>


<!-- Affichage du formulaire -->

<div class="news">
    <h3>
        <?php echo htmlspecialchars($pageCourante); ?>
    </h3>

    <p>
        <?php
        echo nl2br(htmlspecialchars($donnees['contenu']));
        ?>
    </p>
</div>

<form action="../model/Check_message.php" method="post">
    <label for="Participation"> Écrivez les mots souhaités (2 Maximum) : </label><br>
    <input type="Text" name="Participation" id="message" placeholder="Écrivez votre message">
    <input type="Submit" name="BPart" id="BParticipation" value="Send Participation"><br>
    <label for="CloseM">Terminer le Message</label>
    <input type="submit" name="CloseMess" id="CloseM" value="Close Message"><br>
    <label for="CloseD"> Fermez la discussion:</label>
    <input type="Submit" name="CloseDisc" id="CloseD" value="Close Discussion"><br>
</body>
</html>