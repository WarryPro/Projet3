<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 14/08/2018
 * Time: 01:30
 */

namespace Controllers;


class ViewController {

        ################
        ### FRONTEND ###
        ################
    /**
     * connexion appelle la view connexion.php
     */
    public function connexion(){

        require('Views/frontend/connexion.php');
    }

    /**
     * inscription appelle la view inscription.php
     */
    public function inscription(){

        require('Views/frontend/inscription.php');
    }

    /**
     * connexion appelle la view forgotpassword.php
     */
    public function forgotPass(){

        require('Views/frontend/forgotpassword.php');
    }



    ###############
    ### BACKEND ###
    ###############

    public function addPost(){

        require('Views/backend/addPostsView.php');
    }



    public function adminCrudBtn () {

        if((isset($_SESSION['user']) && isset($_SESSION['user_role'])) && ($_SESSION['user_role'] === 'Admin')) {

            if(isset($_GET['action']) && $_GET['action'] === 'admin') {

                require('Views/frontend/components/crudBtnView.php');
            }
        }
    }
}
