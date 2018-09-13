<?php 
namespace Models;

require_once('Manager.php');

class PostManager extends Manager {


    public function addPost() {

        $db = $this -> dbConnect();

        $req = $db -> prepare( "INSERT INTO episodes (id, title, content, created_date, modif_date) VALUES (:id, :title, :content, NOW(), NOW())");

//        $req -> bindValue( ':')
    }

    public function getPosts() {

        $db = $this->dbConnect();
        
        // Recupere les 5 derniers posts
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes ORDER BY created_date DESC LIMIT 0, 5');
    
        return $req;
    }


    public function getPost($postId) {

        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(created_date, \'%d/%m/%Y\') AS created_date_fr FROM episodes WHERE id = ?');

        $req->execute(array($postId));

        $post = $req->fetch();
    
        return $post;
    }

    public function updatePost($postId) {

        $db = $this->dbConnect();
        
        $req = $db->prepare('UPDATE SET title = :title, content = :content, DATE_FORMAT(modif_date, NOW()) AS modif_date_fr FROM episodes WHERE id = :id');

        $req->execute(array($postId));

        $post = $req->fetch();
    
        return $post;
    }

    public function deletePost($postId) {

        $db = $this -> dbConnect();

        $req = $db -> prepare("DELETE FROM episodes WHERE id = ':id'");

        $req -> execute( array( $postId ));

        $post = $req -> fetch();

        return $post;
    }

}