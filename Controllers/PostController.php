<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/12/2018
 * Time: 00:33
 */

namespace Controllers;

use Models\Manager;
use Models\PostManager;


class PostController {


    static function addPosts($id = '0', $title, $content, $image = '') {
        $db = New Manager();
        $db -> dbConnect();

        $postManager = new PostManager(); // Création de l'objet postManager

        $affectedLines = $postManager->addPost($id, $title, $content, $image);

        $sessionRole = $_SESSION['user_role'];
        //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
        if ($affectedLines === false && $sessionRole !== 'Admin') {

            die("Impossible d'ajouter le post !");
        }

        //Les données ont été insérées, on redirige donc le visiteur vers la page admin
        else {

            header('Location: index.php?action=admin');
        }
    }
}