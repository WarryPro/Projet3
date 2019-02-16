<?php 
namespace Models;
use entity\ReportComment;
require_once('Manager.php');


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


//    Métho pour signaler un commentaire
    public function reportComment (ReportComment $reporter) {

        $db = $this->dbConnect();

        $commentId = $reporter->getCommentId();
        $user_accuser = strval( $reporter->getUserAccuser());

        $selReportedComment = $db->prepare("SELECT episode_id FROM comments WHERE id = :comm_id");

        $selReportedComment -> bindParam(':comm_id', $commentId);
        $selReportedComment -> execute();
        $result = $selReportedComment->fetch();


        $req = $db->prepare("INSERT INTO `reported_comms`(`comment_id`, `reported_comment`, `episode_id`, `user_id`, `user_accuser`) 
                                VALUES (:comm_id, 
                                        (SELECT `comment` FROM `comments` WHERE `id` = :id_rep_comm),  
                                        (SELECT `episode_id` FROM `comments` WHERE `id` = :com_episode_id),
                                        (SELECT `id` FROM `users` WHERE `user` = :user_accuser),
                                        :user)");

        $req -> bindParam(':comm_id', $commentId);
        $req -> bindParam(':id_rep_comm', $commentId);
        $req -> bindParam(':com_episode_id', $commentId);
        $req -> bindParam(':user_accuser', $user_accuser);
        $req -> bindParam(':user', $user_accuser);

        $req -> setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\ReportComment');

        $req -> fetch(\PDO::FETCH_ASSOC);
        $req->execute();

        $uri = $result['episode_id'];
        $_SESSION['uri'] = $uri;
    }

}