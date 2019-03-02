<?php

use Controllers\SessionController;
use entity\User;
use Models\CommentManager;
use Models\Manager;
use Models\PostManager;
use Models\UserManager;

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
    $bdd = new \Models\Manager(); //instance de la BDD
    $bdd -> dbConnect();
    $userManager = New UserManager($bdd);

    if($_SESSION['user_role'] === 'Admin') {

        $users = $userManager -> getUsers(); // Appel de la methode getInfos() de cet objet

        return $users;

    }

    header('location: ./index.php');
}


    function updateUser (User $user) {

        $bdd = new Manager(); //instance de la BDD
        $bdd -> dbConnect();

        $userManager = New UserManager($bdd);

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

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $idPost = $_GET['id'];

        $post = $postManager->getPost($idPost);

        $comments = $commentManager->getComments($idPost);
    }

    require('views/frontend/postView.php');
}






function deletePosts($postId) {

    $postManager = new PostManager();

    $post = $postManager -> deletePost($postId);


    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($post === false && $_SESSION['user_role'] !== 'Admin') {

        echo 'Impossible de supprimer le post !';
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

        echo "Impossible d'éditer le post !";
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


function listReportedComments() {

    $commentManager = new CommentManager(); // Création de l'objet CommentManager

    if($_SESSION['user_role'] === 'Admin') {

        $reportedComments = $commentManager -> getReportedComments(); // Appel de la methode getReportedComments() de cet objet

        return $reportedComments;
    }
    else {
        header('location: ./index.php');
    }
}



function addComment($post_id, $user, $comment) {

    $commentManager = new commentManager();

    $affectedLines = $commentManager->postComment($post_id, $user, $comment);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {
        
        echo "Impossible d'ajouter le commentaire !";
    }

    //Les données ont été insérées, on redirige donc le visiteur vers la page du billet pour qu'il puisse voir son commentaire 
    header('Location: index.php?action=post&id=' . $post_id);
}


function delComment($commentId) {
    $commentManager = new commentManager();
    $userSession = New SessionController(); //Instance pour une session
    $affectedLines = $commentManager->delComment($commentId);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {

        echo "Impossible de supprimer le commentaire !";
    }

    //Les données ont été supprimés, on redirige donc le admin
    $userSession -> setFlash("Le commentaire a été supprimé!", 'success');

    header('Location: ./index.php?action=admin');
}
