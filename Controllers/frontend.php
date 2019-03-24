<?php

use Controllers\SessionController;
use entity\User;
use Models\CommentManager;
use Models\Manager;
use Models\PostManager;
use Models\UserManager;

require_once('Models/PostManager.php');
require_once('Models/CommentManager.php');

//affiche la liste d'épisodes
function listPosts() {

    $postManager = new PostManager(); // Création de l'objet postManager

    $posts = $postManager->getPosts(); // Appel de la methode getPosts() de cet objet

    require('Views/frontend/listePostsView.php');
}

//affiche la liste d'épisodes dans la page Admin
function adminListPosts() {

    $sessionController = New SessionController();

    $postManager = New PostManager(); // Création de l'objet postManager

    $userRole = $sessionController -> getSessionRole();

    if($userRole === 'Admin') {

        $posts = $postManager->getPosts(); // Appel de la methode getPosts() de cet objet

        require('Views/backend/addPostsView.php');
    }
    else {
        header('location: ./index.php');
    }

}

//affiche les trois derniers épisodes dans la homepage
function derniersPosts() {

    $postManager = new PostManager(); // Création de l'objet postManager

    $posts = $postManager->getDerniersPosts(); // Appel de la methode getPosts() de cet objet

    require('Views/frontend/derniersPostsView.php');
}

//affiche la page d'un épisode
function post() {

    $postManager = new PostManager();

    $commentManager = new commentManager();

    $idPost = (isset($_GET['id'])) ? filter_var(stripslashes($_GET['id']), FILTER_SANITIZE_STRIPPED) : NULL;

    if (!empty($idPost)) {

        $post = $postManager->getPost($idPost);

        $comments = $commentManager->getComments($idPost);
    }

    require('views/frontend/postView.php');
}

//Supp un épisode par rapport à son id
function deletePosts($postId) {

    $postManager = new PostManager();
    $sessionController = New SessionController();
    $post = $postManager -> deletePost($postId);


    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($post === false && $sessionController -> getSessionRole() !== 'Admin') {

        echo 'Impossible de supprimer le post !';
    }

    //Les données ont été supprimés, on redirige donc le visiteur vers la page admin
    else {
        $sessionController -> setFlash('L\'épisode a été supprimé avec succès!', 'success');
        header('Location: index.php?action=admin');
    }


}

//Recupère un épisode à éditer
function editerPosts ($postId) {

    $sessionController = New SessionController();

    $postManager = New PostManager();

    $userRole = $sessionController -> getSessionRole();

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($postId === false && $userRole !== 'Admin') {

        echo "Impossible d'éditer le post !";
    }

    //Les données ont été édités, on redirige donc le visiteur vers la page admin
    else {
        $post = $postManager -> getPostEditer($postId);
        require ('./Views/backend/postEditView.php');

        return $post;
    }
}

//Màj un épisode
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



//Affichege d'utilisateurs dans la page Admin
function listUsers() {
    $bdd = new \Models\Manager(); //instance de la BDD
    $bdd -> dbConnect();
    $sessionController = New SessionController();
    $userManager = New UserManager($bdd);

    $userRole = $sessionController -> getSessionRole();

    if($userRole === 'Admin') {

        $users = $userManager -> getUsers(); // Appel de la methode getInfos() de cet objet

        return $users;

    }

    header('location: ./index.php');
}

//Màj un utilisateur
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



//Affiche dans la page admin les épisodes signalés
function listReportedComments() {

    $sessionController = New SessionController();

    $commentManager = new CommentManager(); // Création de l'objet CommentManager

    $userRole = $sessionController -> getSessionRole();

    if($userRole === 'Admin') {

        $reportedComments = $commentManager -> getReportedComments(); // Appel de la methode getReportedComments() de cet objet

        return $reportedComments;
    }
//    si n'a pas une session admin
    header('location: ./index.php');

}

//Ajoute un commentaire
function addComment($post_id, $user, $comment) {

    $commentManager = new commentManager();
    $sessionController = New SessionController();

    $affectedLines = $commentManager->postComment($post_id, $user, $comment);

    //On teste donc s'il y a eu une erreur et on arrête tout si jamais il y a eu un souci.
    if ($affectedLines === false) {

        $sessionController -> setFlash("Impossible d'ajouter le commentaire!", 'error');
        //Les données n'ont pas été insérées, on redirige donc le visiteur vers la page du billet
        header('Location: index.php?action=post&id=' . $post_id);
    }
    $sessionController -> setFlash("Le commentaire a été ajouté!", 'success');
    //Les données ont été insérées, on redirige donc le visiteur vers la page du billet pour qu'il puisse voir son commentaire 
    header('Location: index.php?action=post&id=' . $post_id);
}

//Supp un commentaire
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