<?php

    $messageErreur = '';

    if (isset($_GET['erreur'])) {
        switch ($_GET['erreur']) {
            case 'CHAMPS_INCOMPLET':
                $messageErreur = 'Vous n\'avez pas remplis tous les champs !';
                break;
            case 'ERREUR_CONNECTION':
                $messageErreur = 'Vous n\'êtes pas connecté ! Veuillez vous reconnecter !';
                break;
            case 'PSEUDO_MDP_FAUX':
                $messageErreur = 'Pseudo ou mot de passe invalide, veuillez réessayer.';
                break;
            case 'MAIL_EXIST':
                $messageErreur = 'Le mail existe déjà.';
                break;
            case 'NAME_EXIST':
                $messageErreur = 'Le nom existe déjà';
                break;
            case 'VERIF_MDP_FAUX':
                $messageErreur = 'La verification de mot de passe à échoué.';
                break;
            case 'CONDITION_UTILISATION':
                $messageErreur = 'Vous n\'avez pas validez les conditions d\'utilisation';
                break;
            case 'ERROR_ISSET':
                $messageErreur = 'Désolé, il y a eu une erreur dans votre connexion. Veuillez vous reconnecter !';
                break;
            default:
                $messageErreur = 'Erreur inconnue';
        }
    }