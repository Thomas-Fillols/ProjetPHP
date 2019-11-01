<?php

//Récupération de l'ID de la discussion
$IdDiscussion=("SELECT Id_Discussion FROM Discussion WHERE NomDiscussion = '$pageCourante'");

//Récupération de la participation dans un message en fonction du Login
$PartLogin =("SELECT COUNT ID_Message FROM Message WHERE Pseudo='$login' && Id_Discussion='$pageCourante'");

//Récupération du nombre de messages dans une Discussion
$NbMessageDiscussion = "SELECT COUNT FullMessage FROM FullMessage WHERE Id_Discussion='$IdDiscussion' ";

//Récupération de la dernière valeur de la table discussion
$LastWord = "SELECT LAST FullMessage FROM Discussion";

//Récupération des variables
$Participation = $_POST['Participation'];
$NomD = $_POST['NomDiscussion'];
$SubmitPart = $_POST['BPart'];

//Vérification qu'il y a bien deux mots au plus
$NbMots = explode(" ", $Participation);