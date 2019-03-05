<?php 

namespace Controllers;

use entity\User;
use Models\Manager;
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

        header('location: index.php?action=admin');
    }


    /**
     * @param User $user données (id de user) reçus depuis la class User qui est utilisée dans l'index (routeur)
     * @throws \Exception si l'utilisateur n'a pas le droit de editer / supprimer un user
     */
    public function deleteUser(User $user) {

        $bdd = Manager::dbConnect();

        $sessionFlash = New SessionController();

        $userManager = New UserManager($bdd);

        if(!$userManager -> deleteUser($user)) {

            throw new \Exception("Vous devez être connecté en tant qu'administrateur pour réaliser cette action...");
        }

        $sessionFlash -> setFlash('L\'utilisateur a été suprimé avec succès!', 'success');
        header('Location: index.php?action=admin');
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