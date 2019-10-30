<?php
    $messageTitre = 'ERREUR';
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
                $messageErreur = 'Le nom existe déjà.';
                break;
            case 'VERIF_MDP_FAUX':
                $messageErreur = 'La verification de mot de passe à échoué.';
                break;
            case 'CONDITION_UTILISATION':
                $messageErreur = 'Vous n\'avez pas validez les conditions d\'utilisation.';
                break;
            case 'ERROR_ISSET':
                $messageErreur = 'Désolé, il y a eu une erreur dans votre connexion. Veuillez vous reconnecter !';
                break;
            case 'MAIL_VALIDATION_ERROR':
                $messageErreur = 'Vous n\'avez pas rentré un email valide. Veuillez recommencer s\'il vous plaît.';
                break;
            case 'NO_NUMERIC':
                $messageErreur = 'Vous devez rentrer une valeur une numerique';
                break;
            case 'NOUVEAU_MDP':
                $messageErreur = 'Votre changement de mot de passe a bien été validé. Allez verifier votre e-mail.';
                $messageTitre = 'CHANGEMENT DE MOT DE PASSE';
                break;
            case 'VALIDATION_INSCRIPTION':
                $messageErreur = 'Félicitation, vous êtes bien inscrit. Allez vous connecter dès maintenant !';
                $messageTitre = 'BRAVO !';
                break;
            case 'DECONNECTION':
                $messageErreur = 'Vous avez bien été déconnecté.';
                $messageTitre = 'AU REVOIR';
                break;
            default:
                $messageErreur = 'Erreur inconnue.';
        }
    }