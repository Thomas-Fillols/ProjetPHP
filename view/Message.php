<!DOCTYPE html>
<html>
<head>
    <title>Discussion</title>
</head>
<body>
<form action="../model/Check_message.php" method="post">
    <label for="Participation"> Écrivez les mots souhaités (2 Maximum) : </label><br>
    <input type="Text" name="Participation" id="message" placeholder="Écrivez votre message">
    <?php
    if(isset($Close))
        echo '<input type="Text" name="Participation" id="message" value="Écrivez votre message" disabled="disabled">';
    else
    ?>
    <input type="Submit" name="BPart" id="BParticipation" value="Send Participation"><br>
    <label for="CloseM">Terminer le Message</label>
    <input type="submit" name="CloseMess" id="CloseM" value="Close Message"><br>
    <label for="CloseD"> Fermez la discussion:</label>
    <input type="Submit" name="CloseDisc" id="CloseD" value="Close Discussion"><br>
    <label for="nbrDiscussion"> Sélectionner la discussion : </label>
    <label for="OpenD"> Ouvrir une discussion:</label>
    <label for="NameDiscussion"> Nom de discussion souhaitée:</label>
    <input type="Text" name="NomDiscu" id="NameDiscussion" placeholder="Choisir un nom de discussion">
    <input type="Submit" name="BNomD" id="NameDiscu" value="Envoyer nom"><br>
</body>
</html>