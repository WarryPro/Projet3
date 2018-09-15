<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/08/2018
 * Time: 23:23
 */

namespace Controllers;
use Models\UserManager;
use entity\User;
    //gere les données pour les envoyer au manager
class InscriptionController {

    /**
     *Gere les données du formulaire de'inscription (inscripForm) pour l'envoyer au model
     */
    public function inscrUser($db, User $user) {

        $UserManager = new UserManager($db);

        $InscrUser = $UserManager->InscrUser($user);

        if ($InscrUser == FALSE) {
            throw new \Exception("Erreur d'inscription d'un nouveau utilisateur");
        }
        else {
            //todo  Creer le message de bienvenue et rediriger ver l'accueil
            header('location: index.php');

            exit();
        }
    }


    /**
     *finalisation de la connexion admin
     */
    public function deconnexion() {

        $_SESSION = array();

        session_destroy();

        header('location: index.php');
    }
}