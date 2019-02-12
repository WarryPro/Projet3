<?php 
namespace Models;
use entity\ReportComment;
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

//    TODO: signaler un commentaire
    public function reportComment (ReportComment $report) {

        $db = $this->dbConnect();
        $id = $report->getCommentId();

        $req = $db->prepare("INSERT INTO comments(com_reported) VALUES (:com_reported) WHERE id = $id");
//        $req->bindValue(':com_reported', ); // TODO: A reflechir
        $req->execute();
        $reportComment = $req->execute();
        return $reportComment;
    }

}