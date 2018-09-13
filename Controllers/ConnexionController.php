<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/08/2018
 * Time: 23:23
 */

namespace Controllers;

use \Models\Manager;
use \Models\UserManager;
use \entity\User;


    //gere les données pour les envoyer au manager
class ConnexionController {

    /**
     *Gere les données du formulaire d'inscription () pour l'envoyer au model
     */
    public function connUser($db, User $user) {

        $db = new Manager();
        $db->dbConnect();

        $UserManager = new UserManager($db);
        $ConnUser = $UserManager->connUser($user);

        if ($ConnUser == 1) {

            $_SESSION['user'] = $user->getUser();


            header('location: index.php?admin=accueil');

            exit();
        }

        elseif ($ConnUser == 0 ) {

            throw new \Exception('votre mot de passe ou votre utilisateur est incorrect');
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