<?php

session_start();

$pseudo = $_SESSION['pseudo'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];

// Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
$role = 0;

// Sujet du mail pour la reinitialisation du mot de passe
$subject = 'Réinitialisation de mot de passe';

// Permet de se connecter à la base de données
$dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');

//Récupération de l'ID de la discussion
$IdDiscussion = $_GET['Id_Discussion'];

// Récupère le lien vers la page permettant de créer une nouvelle discussion
$newDiscussion = '';

//Récupération de la participation dans un message en fonction du Login
$PartLogin =("SELECT COUNT ID_Message FROM Message WHERE Pseudo='$pseudo' && Id_Discussion='$IdDiscussion'");

//Récupération du nombre de messages dans une Discussion
$NbMessageDiscussion = "SELECT COUNT FullMessage FROM FullMessage WHERE Id_Discussion='$IdDiscussion' ";

// Pour afficher ou non les boutons de connexion, inscription, mon profil et deconnexion
$estConnecte = '';
$nonConnecte = '';

// Pour afficher le formulaire si l'utilisateur est connecté
$Connect= '';

$mailOK = false;

// Page d'affichage courante
$pageCourante = 1;

// Discussions par page par defaut
//$discussionsParPage = 2;

// Permet d'afficher le formulaire ou non en fonction de l'utilisateur connecté(admin ou non)
$adminFormulairePagination = '';

// Permet d'afficher le formulaire permettant de modifier les differents paramètres d'un utilisateur
$modifUtilisateur = '';

// Variables qui recupère toutes les données de la base utilisateur
$discussionsTotalesReq = $dbLink->query('SELECT * FROM Discussion');

// Compte le nombre de ligne dans la base de données
$discussionsTotales = $discussionsTotalesReq->rowCount();