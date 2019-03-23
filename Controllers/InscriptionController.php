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
    public function inscrUser($bdd, User $user) {
        $sessionController = New SessionController();
        $UserManager = new UserManager($bdd);

        $InscrUser = $UserManager->InscrUser($user);

        if ($InscrUser == FALSE) {
            $sessionController -> setFlash("Erreur d'inscription d'un nouveau utilisateur");
            header('location: index.php');
        }
        $sessionController -> setFlash("L'utilisateur a été créé, vous pouvez vous connecter maintenant!", "success");
        header('location: index.php');
    }
}
