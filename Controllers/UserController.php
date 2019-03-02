<?php 

namespace Controllers;

use entity\User;
use Models\UserManager;

require_once 'Models/Manager.php';

Class UserController {

    public function updateInfos($db, User $user) {
    
        $UserManager = new UserManager($db);
        $updateInfos = $UserManager -> setInfos($user);

        if ($updateInfos === FALSE) {

            throw new \Exception('Veuillez vérifier vos informations');
        }

        header('location: index.php?action=admin');
    }

    public function editerUser($db, $userId) {
        $UserManager = new UserManager($db);
        $updateInfos = $UserManager -> updateUser($userId);

        if ($updateInfos === FALSE) {

            throw new \Exception('Veuillez vérifier vos informations');
        }

        var_dump($updateInfos);
        header('location: index.php?action=admin');
    }

    public function emailExist($bdd, User $user) {

        $emailExist = new UserManager($bdd);

        //todo: Metho compareEmail à créér dans la class UserManager
//        if($emailExist -> compareEmail($user) == 1) {
            //todo: Demander à Max comment faire pour envoyer un email de recuperation à l'user
//        }
    }

    /**
     * envoie un objet avec le nouveau password
     *
     *
     */
    public function updatePass($bdd, User $user) {

        $pass = new UserManager($bdd);

        $newpass = $pass -> updatePass($user);
        $id = mt_rand();

        if ($newpass === FALSE) {

            throw new \Exception('Veuillez saisir un mot de passe valide');
        }

        header('location: index.php?action=connexion');
    }
}