<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/08/2018
 * Time: 23:23
 */

namespace Controllers;
use entity\User;
use Models\UserManager;

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

            header('location: index.php');
        }
    }
}