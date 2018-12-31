<?php 
namespace Models;

require_once('Manager.php');

class PostManager extends Manager {


    public function addPost($id, $title, $content, $image_episode) {


        $imgPath = 'public/images/';

        if(!isset($image_episode)) {

            echo 'Il faut charger une image...';
        }
        else {
            if (!((strpos($image_episode['type'], "jpg") ||
                    strpos($image_episode['type'], "jpeg") ||
                    strpos($image_episode['type'], "png")) &&
                    ($image_episode['type'] < 2000000 ))){

                        echo 'La taille de l\'image ne doit dépaser 2MB et l\'image doit être png/jpeg/jpg';
                    }
                    else {
                        if (is_uploaded_file($image_episode['tmp_name'])) {

                            copy($image_episode['tmp_name'], $imgPath .$image_episode['name']);
                        }
                        else
                        {
                            echo "Erreur, l'image n'a pas pu être sauvegardée.";
                        }
                    }
        }

        $db = $this -> dbConnect();

        $req = $db -> prepare ( "INSERT INTO episodes (id, title, content, image_episode, created_date, modif_date) VALUES (?, ?, ?, ?, NOW(), NOW())");

        $affectedLines = $req->execute(array($id, $title, $content, $imgPath . $image_episode['name']));

        return $affectedLines;
    }


    public function getPosts() {

        $db = $this->dbConnect();

        // Recupere la liste de posts
        $req = $db->query('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes ORDER BY id DESC LIMIT 0, 6');

        return $req;
    }

    public function getDerniersPosts() {

        $db = $this->dbConnect();

        // Recupere les 5 derniers posts
        $req = $db->query('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes ORDER BY created_date DESC LIMIT 0, 3');

        return $req;
    }


    public function getPost($postId) {

        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, title, content, image_episode, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes WHERE id = ?');

        $req->execute(array($postId));

        $post = $req->fetch();
    
        return $post;
    }

    public function updatePost($postId) {

        $db = $this->dbConnect();
        
        $req = $db->prepare("UPDATE SET title = :title, content = :content, image_episode = :image_episode, DATE_FORMAT(modif_date, NOW()) AS modif_date_fr FROM episodes WHERE id = :id");

        $req->execute(array($postId));

        $post = $req->fetch();
    
        return $post;
    }

    public function deletePost($postId) {

        $db = $this -> dbConnect();

        $req = $db -> prepare("DELETE FROM episodes WHERE id = :id");

        $req -> execute( array( $postId ));

        $post = $req -> fetch();

        return $post;
    }

}