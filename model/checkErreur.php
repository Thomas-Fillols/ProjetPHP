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
            case 'NAME_NOT_EXIST':
                $messageErreur = 'Le nom n\'existe pas. Veuillez réessayer.';
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
            case 'USER_VALIDATION_ERROR':
                $messageErreur = 'Vous devez rentrer un identifiant valide.';
                break;
            case 'MAIL_VALIDATION_ERROR':
                $messageErreur = 'Vous n\'avez pas rentré un email valide. Veuillez recommencer s\'il vous plaît.';
                break;
            case 'MDP_VALIDATION_ERROR':
                $messageErreur = 'Vous devez rentrer un mot de passe valide.';
                break;
            case 'ROLE_VALIDATION_ERROR':
                $messageErreur = 'Le role n\'est pas bien sélectionné';
                break;
            case 'NO_NUMERIC':
                $messageErreur = 'Vous devez rentrer une valeur une numerique';
                break;
            case 'WORD_MAX':
                $messageErreur = 'Vous ne pouvez pas rentrer plus de 2 mots dans la partie message';
                break;
            case 'WORD_0':
                $messageErreur = 'Veuillez rentrer au minimum 1 mot';
                break;
            case 'WORD_50':
                $messageErreur = 'Vous ne pouvez pas dépasser 50 Caractères';
                break;
            case 'ALWAYS_PARTICIPATION':
                $messageErreur = 'Vous avez déjà participé à ce message';
                break;
            case 'NOT_CREATE_DISCUSSION':
                $messageErreur = 'Le nom de discussion est déjà existant';
                break;
            case 'CONDITION_UTIL':
                $messageErreur = 'En acceptant de vous inscrire, vous acceptez de suivre nos conditions d\'utilisation';
                $messageTitre = 'CONDITIONS D\'UTILISATIONS';
                break;
            case 'CREATE_DISCUSSION':
                $messageErreur = 'Vous avez bien créé une nouvelle discussion';
                $messageTitre = 'CRÉATION D\'UNE NOUVELLE DISCUSSION';
                break;
            case 'CLOSE_DISCUSSION':
                $messageErreur = 'Vous venez de fermer la discussion';
                $messageTitre = 'DISCUSSION FERMÉ';
                break;
            case 'VALIDATION_INSERT_MESSAGE':
                $messageErreur = 'Votre participation a bien été prise en compte';
                $messageTitre = 'PARTICIPATION RÉUSSI';
                break;
            case 'VALIDATION_MODIF':
                $messageErreur = 'Modification réussi';
                $messageTitre = 'Modification réussi';
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