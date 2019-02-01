<?php

use \Models\Manager;
use \Models\PostManager;
use \Models\CommentManager;
use \Models\UserManager;
use \entity\User;
use \Controllers\SessionController;

require_once('Models/PostManager.php');
require_once('Models/CommentManager.php');


function listPosts() {

    $postManager = new PostManager(); // Création de l'objet postManager

    $posts = $postManager->getPosts(); // Appel de la methode getPosts() de cet objet

    require('Views/frontend/listePostsView.php');
}



function adminListPosts() {

    $postManager = New PostManager(); // Création de l'objet postManager

    if($_SESSION['user_role'] === 'Admin') {

        $posts = $postManager->getPosts(); // Appel de la methode getPosts() de cet objet

        require('Views/backend/addPostsView.php');
    }
    else {
        header('location: ./index.php');
    }

}


function listUsers() {
    $db = new \Models\Manager(); //instance de la BDD
    $db -> dbConnect();
    $userManager = New UserManager($db);

    if($_SESSION['user_role'] === 'Admin') {

        $users = $userManager -> getUsers(); // Appel de la methode getInfos() de cet objet

        return $users;

    }
    else {
        header('location: ./index.php');
    }
}


    function updateUser (User $user) {

        $db = new Manager(); //instance de la BDD
        $db -> dbConnect();

        $userManager = New UserManager($db);

        $userSession = New SessionController(); //Instance pour une session
        $affectedLines = $userManager -> updateUser($user);


        if ($affectedLines === false) {
            $userSession -> setFlash("Vous ne pouvez pas éditer cet utilisateur!");
            header('Location: ./index.php?action=admin');
        }
        else {

            $userSession -> setFlash("L'utilisateur a été mise à jour!", 'success');

            header('Location: ./index.php?action=admin');
        }
    }



function derniersPosts() {

    $postManager = new PostManager(); // Création de l'objet postManager

    $posts = $postManager->getDerniersPosts(); // Appel de la methode getPosts() de cet objet

    require('Views/frontend/derniersPostsView.php');
}


function post() {
    
    $postManager = new PostManager();

    $commentManager = new commentManager();

    $post = $postManager->getPost($_GET['id']);
    
    $comments = $commentManager->getComments($_GET['id']);

    require('views/frontend/postView.php');
}






function deletePosts($postId) {

    $postManager = new PostManager();

    $post = $postManager -> deletePost($postId);


    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($post === false && $_SESSION['user_role'] !== 'Admin') {

        die('Impossible de supprimer le post !');
    }

    //Les données ont été supprimés, on redirige donc le visiteur vers la page admin
    else {

        header('Location: index.php?action=admin');
    }


}


function editerPosts ($postId) {

    $postManager = New PostManager();

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($postId === false && $_SESSION['user_role'] !== 'Admin') {

        die("Impossible d'éditer le post !");
    }

    //Les données ont été édités, on redirige donc le visiteur vers la page admin
    else {
        $post = $postManager -> getPostEditer($postId);
        require ('./Views/backend/postEditView.php');

        return $post;
    }
}


function updatePosts ($post) {

    $postManager = New PostManager();
    $userSession = New SessionController(); //Instance pour une session
    $affectedLines = $postManager -> updatePost($post);

    if ($affectedLines === false) {

        $userSession -> setFlash("Vous ne pouvez pas éditer cet épisode!");
        header('Location: ./index.php?action=admin');
    }
    else {

        $userSession -> setFlash("L'épisode a été mise à jour!", 'success');

        header('Location: ./index.php?action=admin');
    }
}


function addComment($post_id, $user, $comment) {

    $commentManager = new commentManager();

    $affectedLines = $commentManager->postComment($post_id, $user, $comment);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {
        
        die("Impossible d'ajouter le commentaire !");
    }

    //Les données ont été insérées, on redirige donc le visiteur vers la page du billet pour qu'il puisse voir son commentaire 
    else {
        
        header('Location: index.php?action=post&id=' . $post_id);
    }
}
