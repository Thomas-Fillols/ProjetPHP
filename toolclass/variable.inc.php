<?php

session_start();

$pseudo = $_SESSION['pseudo'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];

// Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
$role = 0;

// Sujet du mail pour la reinitialisation du mot de passe
$subject = 'Réinitialisation de mot de passe';

// Pour afficher ou non les boutons de connexion, inscription, mon profil et deconnexion
$estConnecte = '';
$nonConnecte = '';

// Sert a afficher ou non l'input de modification de pagination selon si c'est un admin qui est connecté ou non
$adminConnecte = 'style="display: none;"';

// Page d'affichage courante
$pageCourante = 1;

// Discussions par page par defaut
//$discussionsParPage = 2;

// Permet de se connecter à la base de données
$dbLink = new PDO('mysql:host=mysql-freenote.alwaysdata.net;dbname=freenote_sql', 'freenote','zawarudo');

// Variables qui recupère toutes les données de la base utilisateur
$discussionsTotalesReq = $dbLink->query('SELECT * FROM utilisateur');

// Compte le nombre de ligne dans la base de données
$discussionsTotales = $discussionsTotalesReq->rowCount();