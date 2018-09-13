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
            
            header('location: index.php?admin=updateprofil');
            
            exit();
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

        if ($newpass === FALSE)
        {


            throw new \Exception('Veuillez saisir un mot de passe valide');
        }
        else
        {

            header('location: index.php?action=connexion');
            exit();

        }
    }
}