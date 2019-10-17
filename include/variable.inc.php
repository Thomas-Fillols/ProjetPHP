<?php
//Variables session
$pseudo = $_SESSION['pseudo'];
$password = $_SESSION['password'];
#Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
$role = 0;

//Récupération des variables discussion
$Participation = $_POST['Participation'];
$Submit = $_POST['BPart'];
$Close = $_POST['CloseDisc'];
$FFullMess = 0;
//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);
$FFullMess = FindFullMess();
$dbLink=call_data_base();
