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

    public function delComment($commentId) {
        $db = $this -> dbConnect();

        $req = $db -> prepare("DELETE comments, reported_comms FROM `comments` 
                                          INNER JOIN reported_comms 
                                          WHERE comments.id = reported_comms.comment_id 
                                          AND comments.id = :id");

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {

            $req -> bindValue( ':id', $commentId);
            $req -> execute();
            $comment = $req -> execute();

            return $comment;
        }
        else {
            echo "Erreur, l'URL spécifié n'existe pas";
        }
    }


    // Recupere la liste de commentaires signalés
    public function getReportedComments() {

        $db = $this->dbConnect();


        $req = $db->query('SELECT id, comment_id, episode_id, 
                                            reported_comment, user_id, GROUP_CONCAT(DISTINCT user_accuser SEPARATOR ", ") AS users_accusers, 
                                            DATE_FORMAT(reported_date, \'%d/%m/%Y à %Hh%i\') AS date_fr, SUM(num_reports) AS `total_reports` 
                                      FROM reported_comms GROUP BY comment_id
                                      ORDER BY date_fr DESC');

        return $req;
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

        $req = $db->prepare("INSERT INTO `reported_comms`(`comment_id`, `reported_comment`, `episode_id`, `user_id`, `user_accuser`, `reported_date`, `num_reports`) 
                                VALUES (:comm_id, 
                                        (SELECT `comment` FROM `comments` WHERE `id` = :id_rep_comm),  
                                        (SELECT `episode_id` FROM `comments` WHERE `id` = :com_episode_id),
                                        (SELECT `id` FROM `users` WHERE `user` = :user_accuser),
                                        :user, NOW(),  `num_reports`+1) ");

        $req -> bindParam(':comm_id', $commentId);
        $req -> bindParam(':id_rep_comm', $commentId);
        $req -> bindParam(':com_episode_id', $commentId);
        $req -> bindParam(':user_accuser', $user_accuser);
        $req -> bindParam(':user', $user_accuser);

        $req -> setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\ReportComment');

        $req -> fetch(\PDO::FETCH_ASSOC);
        $req->execute();
        //on stocke l'id de l'épisode dans une session pour rediriger après l'utilisateur vers l'épisode correspondant
        $uri = $result['episode_id'];
        $_SESSION['uri'] = $uri;
    }

    /*
     * @param $commentId reçu depuis le controller
     * cette métho returne un utilisateur qui a signalé un commentaire par rapport à l'id du commentaire
     * */
    public function userHasReported($commentId) {

        $db = $this->dbConnect();

        $reqSelUser = $db->prepare("SELECT user_accuser FROM reported_comms WHERE comment_id = :comm_id AND user_accuser = :user_accuser");

        $reqSelUser -> bindParam(':comm_id', $commentId);
        $reqSelUser -> bindParam(':user_accuser', $_SESSION['user']);

        $reqSelUser -> execute();
        $result = $reqSelUser -> fetch(\PDO::FETCH_ASSOC);

        return $result["user_accuser"];
    }

}