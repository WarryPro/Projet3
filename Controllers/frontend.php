<?php

use \Models\PostManager;
use \Models\CommentManager;

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


function addPosts($id = '0', $title, $content, $image = '') {

    $postManager = new PostManager(); // Création de l'objet postManager

    $affectedLines = $postManager->addPost($id, $title, $content, $image);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {

        die('Impossible d\'ajouter le post !');
    }

    //Les données ont été insérées, on redirige donc le visiteur vers la page du billet pour qu'il puisse voir son commentaire
    else {

        header('Location: index.php?action=admin');
    }
}


function addComment($post_id, $user, $comment) {

    $commentManager = new commentManager();

    $affectedLines = $commentManager->postComment($post_id, $user, $comment);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {
        
        die('Impossible d\'ajouter le commentaire !');
    }

    //Les données ont été insérées, on redirige donc le visiteur vers la page du billet pour qu'il puisse voir son commentaire 
    else {
        
        header('Location: index.php?action=post&id=' . $post_id);
    }
}



