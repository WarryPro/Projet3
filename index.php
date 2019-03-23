<?php

session_start();

require ('Controllers/Autoloader.php');
require ('Models/Autoloader.php');
require ('entity/Autoloader.php');
require ('Controllers/frontend.php');

use Controllers\ConnexionController;
use Controllers\InscriptionController;
use Controllers\SessionController;
use Controllers\UserController;
use Controllers\ViewController;
use entity\Image;
use entity\Post;
use entity\User;

\Controllers\Autoloader::register();
\Models\Autoloader::register();
\entity\Autoloader::register();


$bdd = \Models\Manager::dbConnect();

try {

    $action = (isset($_GET['action'])) ? filter_var( $_GET['action'], FILTER_SANITIZE_STRIPPED) : NULL;
    $sessionController = New SessionController();

    switch ($action) {

        case "billets":

            //listPosts();

            $paginationController = New \Controllers\PaginationController();

            //sanitize vars GET // s'il exite le nombre de la page sinon on donne page 1 par defaut
            $page = (isset($_GET['page'])) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRIPPED) : 1;

            if($page) {

                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => $page, 'postsParPage' => 6]);
            }else {
                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => 1, 'postsParPage' => 6]);
            }

            $paginationController -> pagination($pagination);

            break;


        case "connexion":

            $currentUser = $sessionController -> getCurrentUser();

            $view = new ViewController();

            if(!isset($currentUser)) {

                $view -> connexion();
            }
            derniersPosts();

            break;


        case "inscription":

            $currentUser = $sessionController -> getCurrentUser();

            $view = new ViewController();

            if(!isset($currentUser)) {

                $view -> inscription();
            }
            derniersPosts();

            break;


        case "connectuser":

            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postPass = (isset($_POST['pass'])) ? filter_var( $_POST['pass'], FILTER_SANITIZE_STRIPPED) : NULL;

            if(!empty( $postUser) && !empty( $postPass) ) {

                $user = new User(['user' => $postUser, 'pass' => $postPass]);

                $connexion = new ConnexionController();

                $connexion -> connUser($bdd, $user);

            }

            elseif( empty( $postUser) OR empty( $postPass) ) {

                $sessionController -> setFlash('Il faut remplir tous les champs !');
                header('location: index.php?action=connexion');
            }

            break;


        case "inscripuser":

            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postPass = (isset($_POST['pass'])) ? filter_var( $_POST['pass'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;

            if(!empty($postUser) && !empty($postEmail) && !empty($postPass)) {

                $user = new User(['user' => $postUser, 'email' => $postEmail, 'pass' => $postPass]);

                $inscription = new InscriptionController();

                $inscription -> inscrUser($bdd, $user);
            }
            elseif( empty( $postUser) OR empty( $postEmail) OR empty( $postPass)) {

                throw new \Exception('Il faut remplir tous les champs !');
            }

            break;


        case "updateuser":

            //Sanitize vars POST
            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;
            $postUserRole = (isset($_POST['user_role'])) ? filter_var( $_POST['user_role'], FILTER_SANITIZE_STRIPPED) : NULL;

            if(!empty($postUser) && !empty($postEmail) && !empty($postUserRole)) {

                $userId = $_POST['user-id'];

                $user = New User( ['id' => $userId] );
                $userManager = New \Models\UserManager($bdd);
                $userDb = $userManager -> getUser($user->getId());
                $passDb = $userDb['pass'];


                $currentPass = (isset($_POST['current-pass'])) ? filter_var( $_POST['current-pass'], FILTER_SANITIZE_STRIPPED) : NULL;
                $newPass = (isset($_POST['new-pass'])) ? filter_var( $_POST['new-pass'], FILTER_SANITIZE_STRIPPED) : NULL;
//                verification que les champs des mdp ne soient pas vides
                if(!empty($currentPass) && !empty($newPass) && !empty($passDb)) {

//                    verification si le courrent pass et le mdp de la BDD sont egaux
                    if(password_verify($currentPass, $passDb)) {

                        if($newPass !== $currentPass) {

                            $user = New User([  'id' => $userId,
                                'user' => $postUser,
                                'email' => $postEmail,
                                'pass' => $newPass,
                                'role' => $postUserRole]);

                            updateUser($user); // MàJ l'utilisateur avec nouveau mdp
                        }

                        elseif ($newPass === $currentPass) {

                            $user = New User([  'id' => $userId,
                                'user' => $postUser,
                                'email' => $postEmail,
                                'pass' => $currentPass,
                                'role' => $postUserRole]);

                            updateUser($user); // MàJ l'utilisateur avec le current mdp
                        }
                    }
//                    si le current pass et le mdp de la BDD ne sont pas egaux
                    else {
                        $sessionController->setFlash('Mot de passe invalide, il faut mettre votre mot de passe actuel!');
                        header('location: ../index.php?action=admin');
                    }
                }

//               si les champs de des mot passes sont vides on màj que le nom, email et role
                else {
                    $user = New User([  'id' => $userId,
                        'user' => $postUser,
                        'email' => $postEmail,
                        'role' => $postUserRole]);

                    updateUser($user); // MàJ l'utilisateur avec le current mdp
                }

            }
//            si les champs obligatoires (nom, email et role) sont vides
            else {

                $sessionController->setFlash('Les champs user, email et role sont obligatoires!');
                header('location: ../index.php?action=admin');
            }

            break;


        case "supprimeruser":

            $userController = New UserController();

            $userId = (isset($_GET['id']))?filter_var($_GET['id']): NULL;
            $user = New User(['id' => $userId]);
            $userController -> deleteUser($user);

            break;


        case "deconnexion":

            $currentUser = $sessionController -> getCurrentUser();
            // Si $_SESSION est active
            $session = (isset($currentUser)) ? filter_var( $currentUser, FILTER_SANITIZE_STRIPPED) : NULL;

            if($session) {
                $deconnexion = new ConnexionController();

                $deconnexion -> deconnexion();
            }
            break;


        case "forgotpassword":

            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;

            if(!empty($postEmail)) {

                $user = new User(['email' => $postEmail]);
                $update = new UserController();
                $update -> emailExist($bdd, $user);
            }
            else {
                $view = new ViewController();
                $view -> forgotPass();
            }
            break;


        case "admin":

            //adminListPosts();

            $paginationController = New \Controllers\PaginationController();

            $page = (isset($_GET['page'])) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRIPPED) : NULL;

            if($page) {

                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => $page, 'postsParPage' => 2]);
            }else {
                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => 1, 'postsParPage' => 2]);
            }

            $paginationController -> pagination($pagination);

            break;


        case "profil":
            $currentUser = $sessionController -> getCurrentUser();

            $view = new ViewController();

            if(!isset($currentUser)) {

                derniersPosts();
            }
            else {

                $user = New User( ['user' => $currentUser]);

                $userController = New UserController();

                $userProfil = $userController -> userProfil($user);

                $view -> userProfil($userProfil);
            }

            break;


        case "editprofil":

            $currentPass = (!empty($_POST["current-password"])) ? strip_tags($_POST["current-password"]) : NULL;

            $newPass = (!empty($_POST["new-password"])) ? strip_tags($_POST["new-password"]) : NULL;

            $newImageProfil = (isset($_FILES["image-profil"])) ? $_FILES["image-profil"] : NULL;


            // si on modifie que la photo
            if(((!isset($currentPass)) && (!isset($newPass))) && (!empty($newImageProfil['name']))) {
                $userController = New UserController();
                //créé un instance de Image et recupère les données
                $imageEntity = New Image(['path' => 'public/images/',
                                        'type' => $newImageProfil['type'],
                                        'size' => $newImageProfil['size'],
                                        'name' => $newImageProfil['name'],
                                        'tmp_name' => $newImageProfil['tmp_name']]);

                $currentUser = $sessionController->getCurrentUser();

                $user = New User(['user' => $currentUser]);

                $userController -> updateProfil($bdd, $user, $imageEntity);

                $sessionController -> setFlash("La photo a été modifiée!", "success");
                header('Location: index.php?action=profil');

            }
            //si on veut modifier que le mdp
            elseif (((isset($currentPass)) && (isset($newPass))) && (empty($newImageProfil['name']))) {

                if($currentPass === $newPass) {

                    $sessionController -> setFlash("Le nouveau mot de passe doit être different à l'actuel !");
                    header('Location: index.php?action=profil');
                }
                else {

                    $userController = New UserController();
                    $currentUser = $sessionController->getCurrentUser();

                    $passwordVerify = $userController -> passVerify($currentUser, $currentPass, $newPass);

                    if($passwordVerify) {

                        $user = New User(['user' => $currentUser,'pass' => $newPass]);

                        $userController -> updatePass($bdd, $user);
                        $sessionController -> setFlash('Le mot de passe a été modifié!', 'success');
                        header('Location: index.php?action=profil');
                    }

                    else {
                        $sessionController -> setFlash('Le mot de passe actuel est incorrect!');
                        header('Location: index.php?action=profil');

                    }
                }
            }
            // si on veut modifier la photo et le mdp
            elseif (((isset($currentPass)) && (isset($newPass))) && (!empty($newImageProfil['name']))) {

                if($currentPass === $newPass) {

                    $sessionController -> setFlash("Le nouveau mot de passe doit être different à l'actuel !");

                    header('Location: index.php?action=profil');
                }
                else {

                    $userController = New UserController();
                    $currentUser = $sessionController->getCurrentUser();

                    $passwordVerify = $userController -> passVerify($currentUser, $currentPass, $newPass);

                    if($passwordVerify) {

                        $user = New User(['user' => $currentUser,'pass' => $newPass]);
                        //créé un instance de Image et recupère les données
                        $imageEntity = New Image(['path' => 'public/images/',
                            'type' => $newImageProfil['type'],
                            'size' => $newImageProfil['size'],
                            'name' => $newImageProfil['name'],
                            'tmp_name' => $newImageProfil['tmp_name']]);

                        $userController -> updateProfil($bdd, $user, $imageEntity);
                        $sessionController -> setFlash('Le profil a été modifié!', 'success');
                        header('Location: index.php?action=profil');
                    }

                    else {
                        $sessionController -> setFlash('Le mot de passe actuel est incorrect!');
                        header('Location: index.php?action=profil');

                    }
                }
            }
            // si l'utilisateur n'a pas remplis aucun champs
            else {
                $sessionController -> setFlash("Il faut remplir les champs!");
                header('Location: index.php?action=profil');
            }

            break;

        case "post":

            $getId = (isset($_GET['id'])) ? filter_var( $_GET['id'], FILTER_SANITIZE_STRIPPED) : NULL;

            if ($getId > 0) {

                post();
            }
            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;


        case "addPost":

            // S'il y a un titre et contenu dans le post a ajouter
            if (!empty($_POST['titre']) && !empty($_POST['post-content'])) {
                // Si est une image et sa taille est plus petite de 2MB
                if ((($_FILES['img-post']['type'] === 'image/jpg') ||
                        ($_FILES['img-post']['type'] === 'image/jpeg') ||
                        ($_FILES['img-post']['type'] === 'image/png')) &&
                    ($_FILES['img-post']['size'] < 2000000) ) {

                    \Controllers\PostController::addPosts($_POST['post-id'], $_POST['titre'], $_POST['post-content'], $_FILES['img-post']);
                }
                else {
                    echo 'Il faut charger une image PNG, JPEG ou JPG maximum de 2MB ...';
                }
            }
            else {
                echo ('Tous les champs ne sont pas remplis !');
            }

            break;


        case "supprimer":

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                deletePosts($_GET['id']);
            }

            else {

                throw new Exception('Aucun identifiant de billet supprimé...');
            }
            break;


        case "editer":

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                editerPosts($_GET['id']);
            }

            else {

                throw new Exception('Aucun identifiant de billet édité...');
            }
            break;


        case "updatePost":

            if(!empty($_POST['titre']) && !empty($_POST['post-content'])) {

                $post = New Post(['idPost' => $_POST['post-id'] ,'title' => $_POST['titre'], 'content' => $_POST['post-content']]);

                updatePosts($post); // MàJ l'épisode
            }
            else {
                throw new \Exception('Il faut remplir tous les champs !');
            }
            break;


        case "addComment":

            $currentUser = $sessionController -> getCurrentUser(); // Utilisateur avec une session

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                if (!empty($currentUser) && !empty($_POST['comment'])) {

                    addComment($_GET['id'], $currentUser, $_POST['comment']);
                }
                else {

                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }

            break;


        case "supreportedcom":

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delComment($_GET['id']);
            }
            else {

                throw new Exception('Une erreur est survenue, aucun commentaire à supprimer !');
            }
            break;


        case "validatecomment":

            $idReportedComment = (isset($_GET['id']))?filter_var($_GET['id']): NULL;

            $commentController = New \Controllers\CommentController();

            $reportComment = New \entity\ReportComment(['commentId' => $idReportedComment]);

            $commentController -> validateComment($reportComment);

            break;


        default:

            derniersPosts();
    }
}
catch(Exception $e) {

    echo 'Erreur : ' . $e->getMessage();
}
