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
     *Gere les données du formulaire de connexion pour les envoyer au model
     *
     * @user à se connecter
     */
    public function connUser($db, User $user) {

        $db = new Manager(); //instance de la BDD
        $db->dbConnect();

        $UserManager = new UserManager($db);
        $ConnUser = $UserManager -> connUser($user); // Connexion de @user return 1 si true 0 si false


        if ($ConnUser == 1) {
            $userSession = New SessionController(); //Instance pour une session

            $userSession -> setCurrentUser($user); // créé une session pour @user

            $isAdmin = $UserManager -> isAdmin($user); // return un bool

            // si @user a le role Admin
            if($isAdmin) {

                header('location: index.php?admin=accueil');
            }
            else {

                header('location: index.php');

            }

//          $_SESSION['user'] = $user->getUser();
            exit();
        }

        //si n'a pas une connexion (mdp incorrect ou @user n'existe pas dans la BDD)
        elseif ($ConnUser == 0 ) {

//            header('location: index.php?action=connexion');
            throw new \Exception('votre mot de passe ou votre utilisateur est incorrect');
        }
    }


    /**
     *finalisation de la connexion admin
     */
    public function deconnexion() {

        $userSession = New SessionController();

        $userSession -> closeSession();

        header('location: index.php');
    }
}