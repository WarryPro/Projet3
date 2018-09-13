<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 14/08/2018
 * Time: 01:30
 */

namespace Controllers;


class ViewController {

    /**
     *
     */
    public function connexion()
    {
        require('Views/frontend/connexion.php');
    }

    public function inscription()
    {
        require('Views/frontend/inscription.php');
    }
}