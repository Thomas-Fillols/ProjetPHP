<!DOCTYPE html>
<html>
<head>
    <title>Discussion</title>
</head>
<body>
<div >
    <h3>
        <strong> Discussion :</strong>
        <?php echo htmlspecialchars($Ddis['NomDiscussion']); ?>
    </h3>

    <p>
        <?php
        echo nl2br(htmlspecialchars($DFMess['FullMessage']));
        ?>
    </p>
    <p>
        Message en cours: <br>
        <?php
        echo nl2br(htmlspecialchars($DMessInPr['Message']));
        ?>
    </p>
</div>
<form action="../model/Check_message.php" method="post">
    <label for="Participation"> Écrivez les mots souhaités (2 Maximum) : </label><br>
    <input type="Text" name="Participation" id="message" placeholder="Écrivez votre message">
    <input type="Submit" name="BPart" id="BParticipation" value="Send Participation"><br>
    <input id="CloseD" type="submit" name="CloseDisc" value="fermer discussion">
</body>
</html>