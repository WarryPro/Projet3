<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/12/2018
 * Time: 22:53
 */

namespace Controllers;

use entity\User;


class SessionController {

    public function __construct() {
//        session_start();

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

        $sessionUser = (isset($_SESSION['user'])) ? $_SESSION['user'] : NULL;

        return $sessionUser;
    }


    /*
     * Méthode pour configurer une alert quand il y a un erreur
     * @message message à afficher, @type le type d'erreur
     * */
    public function setFlash($message, $type = 'error') {

        $_SESSION['flash'] = array(
            'message'   => $message,
            'type'      => $type
        );
    }


    public function getFlash () {

        if(isset($_SESSION['flash'])) {

            echo ('<p id="alert" class="alert alert__' . $_SESSION['flash']['type'] .'">'
                                . $_SESSION['flash']['message']
                            .'</p>');
        }
    }

    /*
     * Méthode pour fermer une session
     * */
    public function closeSession () {

        $_SESSION = array();
        session_destroy();
    }
}