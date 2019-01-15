<?php 
namespace Models;

require_once('Models/Manager.php');


class CommentManager extends Manager {

    // Obtenir commentaires
    public function getComments($postId) {

        $db = $this->dbConnect();
        
        $comments = $db->prepare('SELECT id, user, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr FROM comments WHERE episode_id = ? ORDER BY comment_date DESC');

        $comments->execute(array($postId));

        return $comments;
    }

    // Créér un commentaire
    public function postComment($postId, $user, $comment) {
        
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments(episode_id, user, comment, comment_date) VALUES(?, ?, ?, NOW())');
        
        $affectedLines = $comments->execute(array($postId, $user, $comment));

        return $affectedLines;
    }

}