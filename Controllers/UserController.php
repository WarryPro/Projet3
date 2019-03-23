<?php 

namespace Controllers;

use entity\Image;
use entity\User;
use Models\Manager;
use Models\UserManager;

require_once 'Models/Manager.php';

Class UserController {

    public function updateProfil($bdd, User $user, Image $image) {

        $UserManager = new UserManager($bdd);

        $updateInfos = $UserManager -> setInfosProfil($user, $image);

        if ($updateInfos === FALSE) {
            return false;
        }else {
            return true;
        }
    }



    public function userProfil(User $user) {
        $bdd = Manager::dbConnect();

        $userManager = New UserManager($bdd);

        $userDb = $userManager -> getUserProfil($user->getUser());

        return $userDb;
    }


    public function editerUser($bdd, $userId) {
        $UserManager = new UserManager($bdd);
        $sessionFlash = New SessionController();
        $updateInfos = $UserManager -> updateUser($userId);

        if ($updateInfos === FALSE) {

            $sessionFlash -> setFlash('Veuillez vérifier vos informations');
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
            $sessionFlash -> setFlash("Vous devez être connecté en tant qu'administrateur pour réaliser cette action...");
        }

        $sessionFlash -> setFlash('L\'utilisateur a été suprimé avec succès!', 'success');
        header('Location: index.php?action=admin');
    }

    /**
     * envoie un objet avec le nouveau password
     *
     *
     */
    public function updatePass($bdd, User $user) {

        $sessionController = New SessionController();
        $userManager = new UserManager($bdd);

        $updatePass = $userManager -> updatePass($user);


        if (!$updatePass) {

            return $updatePass;
        }else {

            return $updatePass;
        }
    }


    public function passVerify($user, $currentPass, $newPass) {

        $bdd = Manager::dbConnect();

        $userManager = New UserManager($bdd);

        $passVerify = $userManager -> passVerify($user, $currentPass, $newPass);

        return $passVerify;
    }
}