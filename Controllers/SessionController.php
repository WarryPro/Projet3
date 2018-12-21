<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/12/2018
 * Time: 22:53
 */

namespace Controllers;

use \entity\User;


class SessionController {

    public function __construct() {

        session_start();
    }

    /*
     * méthode pour recuperer @user pour initialiser une session
     **/
    public function setCurrentUser (User $user) {

        $_SESSION['user'] = $user -> getUser(); //crée la session pour @user
    }


    /*
     * Obtient le @user qu'a une session initialisée
     **/
    public function getCurrentUser () {
        return $_SESSION['user'];
    }

    /*
     * Méthode pour fermer une session
     * */
    public function closeSession () {

        $_SESSION = array();
        session_destroy();
    }
}