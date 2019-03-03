<?php

session_start();

require ('Controllers/Autoloader.php');
require ('Models/Autoloader.php');
require ('entity/Autoloader.php');
require ('Controllers/frontend.php');

use Controllers\ConnexionController;
use Controllers\InscriptionController;
use Controllers\UserController;
use Controllers\ViewController;
use entity\Post;
use entity\User;

\Controllers\Autoloader::register();
\Models\Autoloader::register();
\entity\Autoloader::register();


$db = \Models\Manager::dbConnect();
try {
    $action = (isset($_GET['action'])) ? filter_var( $_GET['action'], FILTER_SANITIZE_STRIPPED) : NULL;

    if ($action) {

        if ($action == 'billets') {

//            listPosts();

            $paginationController = New \Controllers\PaginationController();

            //sanitize vars GET // s'il exite le nombre de la page sinon on donne page 1 par defaut
            $page = (isset($_GET['page'])) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRIPPED) : 1;

            if($page) {

                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => $page, 'postsParPage' => 6]);
            }else {
                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => 1, 'postsParPage' => 6]);
            }

            $paginationController -> pagination($pagination);

//            $viewController = New ViewController();
//            $viewController -> listEpisodes($result);

        }


//        Redirige vers la page de connection
        elseif ($action === 'connexion') {

            $view = new ViewController();

            $view -> connexion();
        }

        // VERIFIER la conn de l'utilisateur
        elseif ($action === 'connectuser') {

            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postPass = (isset($_POST['pass'])) ? filter_var( $_POST['pass'], FILTER_SANITIZE_STRIPPED) : NULL;

            if(!empty( $postUser) && !empty( $postPass) ) {

                $user = new User(['user' => $postUser, 'pass' => $postPass]);

                $connexion = new ConnexionController();

                $connexion -> connUser($db, $user);

            }

            elseif( empty( $postUser) OR empty( $postPass) ) {

                throw new \Exception('Il faut remplir tous les champs !');
            }
        }


//        Redirige vers la page d'inscription
        elseif ($action === 'inscription') {

            $view = new ViewController();

            $view -> inscription();
        }


        elseif($action === 'inscripuser') {

            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postPass = (isset($_POST['pass'])) ? filter_var( $_POST['pass'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;

            if(!empty($postUser) && !empty($postEmail) && !empty($postPass)) {

                $user = new User(['user' => $postUser, 'email' => $postEmail, 'pass' => $postPass]);

                $inscription = new InscriptionController();

                $inscription -> inscrUser($db, $user);
            }
            elseif( empty( $postUser) OR empty( $postEmail) OR empty( $postPass)) {

                throw new \Exception('Il faut remplir tous les champs !');
            }
        }



        //    redirige vers la page de recuperation de mdp (forgotpassword)
        elseif($action === 'forgotpassword') {

            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;

            if(!empty($postEmail)) {

                $user = new User(['email' => $postEmail]);
                $update = new UserController();
                $update -> emailExist($db, $user);
            }
            else {
                $view = new ViewController();
                $view -> forgotPass();
            }
        }


        elseif($action === 'deconnexion') {
            // Si $_SESSION est active
            $session = (isset($_SESSION['user'])) ? filter_var( $_SESSION['user'], FILTER_SANITIZE_STRIPPED) : NULL;

            if($session) {
                $deconnexion = new ConnexionController();

                $deconnexion -> deconnexion();
            }
        }



        elseif ($action == 'post') {

            $getId = (isset($_GET['id'])) ? filter_var( $_GET['id'], FILTER_SANITIZE_STRIPPED) : NULL;

            if ($getId > 0) {

                post();
            }

            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


        elseif ($action === 'admin') {

//            adminListPosts();

            $paginationController = New \Controllers\PaginationController();

            $page = (isset($_GET['page'])) ? filter_var( $_GET['page'], FILTER_SANITIZE_STRIPPED) : NULL;

            if($page) {

                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => $page, 'postsParPage' => 2]);
            }else {
                $pagination = New \entity\Pagination(['table' => 'episodes', 'page' => 1, 'postsParPage' => 2]);
            }

            $paginationController -> pagination($pagination);

        }



        elseif ($action === 'updateuser') {
            //Sanitize vars POST
            $postUser = (isset($_POST['user'])) ? filter_var( $_POST['user'], FILTER_SANITIZE_STRIPPED) : NULL;
            $postEmail = (isset($_POST['email'])) ? filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) : NULL;
            $postUserRole = (isset($_POST['user_role'])) ? filter_var( $_POST['user_role'], FILTER_SANITIZE_STRIPPED) : NULL;

            if(!empty($postUser) && !empty($postEmail) && !empty($postUserRole)) {

                $userId = (isset($_POST['user-id'])) ? filter_var( $_POST['user-id'], FILTER_SANITIZE_STRIPPED) : NULL;

                $user = New User( ['id' => $userId] );
                $userManager = New \Models\UserManager($db);
                $userDb = $userManager -> getUser($user->getId());
                $passDb = $userDb['pass'];


                $currentPass = (isset($_POST['current-pass'])) ? filter_var( $_POST['current-pass'], FILTER_SANITIZE_STRIPPED) : NULL;
                $newPass = (isset($_POST['new-pass'])) ? filter_var( $_POST['new-pass'], FILTER_SANITIZE_STRIPPED) : NULL;
//                verification que les champs des mdp ne soient pas vides
                if(!empty($currentPass) && !empty($newPass) && !empty($passDb)) {

//                    verification si le courrent pass et le mdp de la BDD sont egaux
                    if(password_verify($currentPass, $passDb)) {

                        if($newPass !== $currentPass) {

                            $user = New User([  'id' => intval($userId['user-id']),
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

                        echo "<p>Mot de passe invalide, il faut mettre votre mot de passe actuel!</p>";
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

                return "<p>Les champs user, email et role sont obligatoires!</p>";
//                throw new \Exception('Il faut remplir tous les champs !');
            }

        }



        elseif($action === 'supprimeruser') {

            $userController = New UserController();

            $userId = (isset($_GET['id']))?filter_var($_GET['id']): NULL;
            $user = New User(['id' => $userId]);
            $userController -> deleteUser($user);

        }



        elseif ($action === 'addPost') {
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
        }


        elseif ($action == 'supprimer') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                deletePosts($_GET['id']);
            }

            else {

                throw new Exception('Aucun identifiant de billet supprimé...');
            }
        }



        elseif ($action == 'editer') {

//            require('Views/backend/postEditView.php');

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                editerPosts($_GET['id']);
            }

            else {

                throw new Exception('Aucun identifiant de billet édité...');
            }
        }

        elseif ($action === 'updatePost') {

            if(!empty($_POST['titre']) && !empty($_POST['post-content'])) {
                $post = New Post(['id' => $_POST['post-id'] ,'title' => $_POST['titre'], 'content' => $_POST['post-content']]);


                updatePosts($post); // MàJ l'épisode


            }
            else {
                throw new \Exception('Il faut remplir tous les champs !');
            }

        }




//        ajouter un commentaire
        elseif ($action == 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                if (!empty($_SESSION['user']) && !empty($_POST['comment'])) {

                    addComment($_GET['id'], $_SESSION['user'], $_POST['comment']);
                }
                else {

                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }

            else {

                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


//        supprimer un commentaire
        elseif ($action == 'supreportedcom') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delComment($_GET['id']);
            }
            else {

                throw new Exception('Une erreur est survenue, aucun commentaire à supprimer !');
            }
        }

    }
    else {

        derniersPosts();
    }
}
catch(Exception $e) {

    echo 'Erreur : ' . $e->getMessage();
}
