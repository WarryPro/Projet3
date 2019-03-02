<?php 
namespace Models;

use entity\Post;

require_once('Manager.php');

class PostManager extends Manager {


    public function addPost($id, $title, $content, $image_episode) {

        $bdd = $this -> dbConnect();

        $imgPath = 'public/images/';

        if(!isset($image_episode)) {

            echo 'Il faut charger une image...';
        }
        else {
            if (is_uploaded_file($image_episode['tmp_name'])) {

                copy($image_episode['tmp_name'], $imgPath .$image_episode['name']);

                $req = $bdd -> prepare ( "INSERT INTO episodes (id, title, content, image_episode, created_date, modif_date) VALUES (?, ?, ?, ?, NOW(), NOW())");

                $affectedLines = $req->execute(array($id, $title, $content, $imgPath . $image_episode['name']));

                return $affectedLines;
            }
            else {
                New \Exception( "Erreur, l'image n'a pas pu être sauvegardée.");
            }
        }
    }


    public function getPosts() {

        $bdd = $this->dbConnect();

        // Recupere la liste de posts
        $req = $bdd->query('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes ORDER BY id DESC');

        return $req;
    }

    public function getDerniersPosts() {

        $bdd = $this->dbConnect();

        // Recupere les 5 derniers posts
        $req = $bdd->query('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes ORDER BY created_date DESC LIMIT 0, 3');

        return $req;
    }


    public function getPost($postId) {

        $bdd = $this->dbConnect();
        
        $req = $bdd->prepare('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes WHERE id = ?');

        $req->execute(array($postId));

        $post = $req->fetch();
    
        return $post;
    }



    public function getPostEditer($postId) {

        $bdd = $this->dbConnect();

        if(isset($postId)) {

            $req = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(modif_date, \'%d/%m/%Y\') AS modif_date_fr FROM episodes WHERE id = ?');

            $req->execute(array($postId));

            $post = $req->fetch();

            return $post;
        }
        else {
            echo "Aucun épisode à éditer...";
        }
    }


    public function updatePost(Post $post) {

        $bdd = $this -> dbConnect();

        $req = $bdd -> prepare("UPDATE `episodes` SET `title`= :title, `content`= :content, `modif_date` = NOW() WHERE `id` = :id LIMIT 1");

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {

            $req -> bindValue( ':id', $post -> getId());
            $req -> bindValue( ':title', $post -> getTitle());
            $req -> bindValue( ':content', $post -> getContent());

            $postUpdate = $req -> execute();

            return $postUpdate;
        }
        else {
            echo "Erreur au momment de mettre à jour l'épisode";
        }
    }


    public function deletePost($postId) {

        $bdd = $this -> dbConnect();
        
        $reqEp = $bdd -> prepare("DELETE FROM episodes WHERE id = :id LIMIT 1");
        $reqCo = $bdd -> prepare("DELETE FROM comments WHERE episode_id = :id");
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {

            $reqEp -> bindValue( ':id', $postId);
            $reqCo -> bindValue( ':id', $postId);
            $reqCo -> execute();
            $post = $reqEp -> execute();

            return $post;
        }

        echo "Erreur, l'URL spécifié n'existe pas";

    }

}