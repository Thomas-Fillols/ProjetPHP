<?php

session_start();

$pseudo = $_SESSION['pseudo'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];

#Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
$role = 0;

#Sujet du mail pour la reinitialisation du mot de passe
$subject = 'Réinitialisation de mot de passe';



//Récupération de l'ID de la discussion
$IdDiscussion = $_GET['Id_Discussion'];

//Récupération de la participation dans un message en fonction du Login
$PartLogin =("SELECT COUNT ID_Message FROM Message WHERE Pseudo='$pseudo' && Id_Discussion='$IdDiscussion'");

//Récupération du nombre de messages dans une Discussion
$NbMessageDiscussion = "SELECT COUNT FullMessage FROM FullMessage WHERE Id_Discussion='$IdDiscussion' ";

//Récupération de la dernière valeur de la table discussion
$LastWord = "SELECT LAST FullMessage FROM Discussion";

//Récupération du message entier
$FMess = "SELECT Message FROM Message WHERE Id_Discussion='$IdDiscussion'";


//Récupération des variables de POST
$Participation = $_POST['Participation'];
$CloseDisc = $_POST['CloseDisc'];
$NomD = $_POST['NomDiscussion'];
$SubmitPart = $_POST['BPart'];

//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);

