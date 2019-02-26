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

    /*
     * appel le compossant pagination
     * */
    public function pagination (){

        require('Views/frontend/pagination.php');
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
}
