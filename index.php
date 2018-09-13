<?php

session_start();

require ('Controllers/Autoloader.php');
require ('Models/Autoloader.php');
require ('entity/Autoloader.php');
require ('Controllers/frontend.php');

use \Controllers\ConnexionController;
use \Controllers\ViewController;
use \entity\User;

\Controllers\Autoloader::register();
\Models\Autoloader::register();
\entity\Autoloader::register();


$db = \Models\Manager::dbConnect();
try {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'listPosts') {

            listPosts();
        }

//        Redirige vers la page de connection
        elseif ($_GET['action'] === 'connexion') {

            $view = new ViewController();

            $view -> connexion();
        }

        // VERIFIER la conn de l'utilisateur
        elseif ($_GET['action'] === 'connectuser') {

            if(!empty( $_POST['user']) && !empty( $_POST['pass']) ) {

                $user = new User(['user' => $_POST['user'], 'pass' => $_POST['pass']]);

                $connexion = new ConnexionController();

                $connexion -> connUser($db, $user);

            }

            elseif( empty( $_GET['user']) OR empty( $_GET['pass']) ) {

                throw new \Exception('Il faut remplir tous les champs !');
            }
        }


//        Redirige vers la page d'inscription
        elseif ($_GET['action'] === 'inscription') {

            $view = new ViewController();

            $view -> inscription();
        }




        elseif ($_GET['action'] == 'post') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                post();
            }

            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


        elseif ($_GET['action'] == 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                if (!empty($_POST['user']) && !empty($_POST['comment'])) {

                    addComment($_GET['id'], $_POST['user'], $_POST['comment']);
                }
                else {

                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }

            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {

        listPosts();
    }
}
catch(Exception $e) {

    echo 'Erreur : ' . $e->getMessage();
}
