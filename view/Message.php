<!DOCTYPE html>
<html>
<head>
    <title>Discussion</title>
</head>
<body>
<div >
    <h3>
        <strong> Discussion :</strong>
        <?php
        echo htmlspecialchars($Ddis['NomDiscussion']); ?>
    </h3>

    <p>
        <?php
        foreach ($DFMess as $row => $values) {
            echo nl2br(htmlspecialchars($values['FullMessage']));?><br>
        <?php }
        ?>
    </p>
    <p>
        Message en cours: <br>
        <?php
        foreach ($DMessInPr as $row => $values) {
            echo nl2br(htmlspecialchars($values["Message"]));
            echo ' ';
        }
        ?>
    </p>
</div>
<form action="../model/Check_message.php?Id_Discussion=<?php echo $IdDiscussion; ?>" method="post">
    <label for="Participation"> Écrivez les mots souhaités (2 Maximum) : </label><br>
    <input type="Text" name="Participation" id="message" placeholder="Écrivez votre message">
    <input type="Submit" name="BPart" id="BParticipation" value="Send Participation""><br>
    <input id="CloseD" type="submit" name="CloseDisc" value="fermer discussion">

</form>
</body>
</html>