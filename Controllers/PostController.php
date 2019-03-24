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
        $bdd = New Manager();
        $bdd -> dbConnect();
        $sessionController = New SessionController();

        $postManager = new PostManager(); // Création de l'objet postManager

        $affectedLines = $postManager->addPost($id, $title, $content, $image);

        $sessionRole = $sessionController -> getSessionRole();
        //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
        if ($affectedLines === false && $sessionRole !== 'Admin') {

            echo "Impossible d'ajouter le post !";
        }
        $sessionController -> setFlash('L\'épisode a été ajouté avec succès!', 'success');
        //Les données ont été insérées, on redirige donc le visiteur vers la page admin
        header('Location: index.php?action=admin');
    }


    public function postsUserHasCommented($user) {

      $postManager = New PostManager();

      $episodes = $postManager -> getPostsUserHasCommented($user);

      if($episodes) {
          return $episodes;
      }
      return false;
    }
}