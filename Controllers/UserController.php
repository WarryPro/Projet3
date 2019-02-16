<?php 

namespace Controllers;

use \entity\User;
use \Models\UserManager;

require_once ('Models/Manager.php');

Class UserController {

    public function updateInfos($db, User $user) {
    
        $UserManager = new UserManager($db);
        $updateInfos = $UserManager -> setInfos($user);

        if ($updateInfos === FALSE) {

            throw new \Exception('Veuillez vérifier vos informations');
        }
        else {
            
            header('location: index.php?action=admin');
            
            exit();
        }
    }

    public function editerUser($db, $userId) {
        $UserManager = new UserManager($db);
        $updateInfos = $UserManager -> updateUser($userId);

        if ($updateInfos === FALSE) {

            throw new \Exception('Veuillez vérifier vos informations');
        }
        else {
                var_dump($updateInfos);
//            header('location: index.php?action=admin');

            exit();
        }
    }

    public function emailExist($db, User $user) {

        $emailExist = new UserManager($db);

        //todo: Metho compareEmail à créér dans la class UserManager
        if($emailExist -> compareEmail($user) == 1) {
            //todo: Demander à Max comment faire pour envoyer un email de recuperation à l'user
        }
    }

    /**
     * envoie un objet avec le nouveau password
     *
     *
     */
    public function updatePass($db, User $user) {

        $pass = new UserManager($db);

        $newpass = $pass -> updatePass($user);
        $id = mt_rand();

        if ($newpass === FALSE) {

            throw new \Exception('Veuillez saisir un mot de passe valide');
        }
        else {

            header('location: index.php?action=connexion');
            exit();

        }
    }
}