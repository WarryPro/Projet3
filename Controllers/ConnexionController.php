<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/08/2018
 * Time: 23:23
 */

namespace Controllers;

use entity\User;
use Models\Manager;
use Models\UserManager;


//gere les données pour les envoyer au manager
class ConnexionController {

    /**
     *Gere les données du formulaire de connexion pour les envoyer au model
     *
     * @user à se connecter
     */
    public function connUser($bdd, User $user) {

        $bdd = new Manager(); //instance de la BDD
        $bdd->dbConnect();

        $UserManager = new UserManager($bdd);
        $ConnUser = $UserManager -> connUser($user); // Connexion de @user return 1 si true 0 si false
        $userSession = New SessionController(); //Instance pour une session


        if ($ConnUser == 1) {

            $userSession -> setCurrentUser($user); // créé une session pour @user

            $isAdmin = $UserManager -> isAdmin($user); // return un bool

            // si @user a le role Admin
            if($isAdmin) {

                header('location: index.php?admin');
            }

            header('location: index.php');
        }

        //s'il n'y a pas une connexion (mdp incorrect ou @user n'existe pas dans la BDD)
        elseif ($ConnUser == 0 ) {

            $userSession -> setFlash('votre mot de passe ou votre utilisateur est incorrect');
            header('location: index.php?action=connexion');

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