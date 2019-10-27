<?php

session_start();

$pseudo = $_SESSION['pseudo'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];

#Le rôle 0 correspond au grade membre et le rôle 1 au rôle super-administrateur
$role = 0;

#Sujet du mail pour la reinitialisation du mot de passe
$subject = 'Réinitialisation de mot de passe';