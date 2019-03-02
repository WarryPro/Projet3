<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:23
 */

namespace Controllers;
use entity\ReportComment;
use Models\CommentManager;

class CommentController {

/**
 * méthode controlleur pour signaler un commentaire
 * @param $report prend les données passe par la class ReportComment et
 * les envoie à la méthode reportComment de la class CommentManager
 */
    public function reportComment(ReportComment $report) {

        $sessionController = New SessionController();

        $userAccuser = $this-> userHasReported($report->getCommentId()); // Bool

//        si l'utilisateur n'a pas encore signalé le commentaire
        if(!$userAccuser) {

            $commentManager = New CommentManager();
//        $uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $reportComment = $commentManager -> reportComment($report);

            if($reportComment === FALSE) {

                echo "Une erreur est survenu";
            }
            $sessionController->setFlash('Le commentaire a été signalé', 'success');
            header('location: ../index.php?action=post&id='. $_SESSION['uri']);
            unset($_SESSION['uri']); // Supp la session pour cette var
        }

//      si il a déjà signalé avant alors en envoie une alerte
        $sessionController->setFlash('Vous avez déjà signalé ce commentaire...', 'error');
        header('location: ../index.php?action=post&id='. $_SESSION['uri']);
        unset($_SESSION['uri']); // Supp la session pour cette var

    }

    /*
     * Return un bool si l'utilisateur returné par la méthode userHasReported de la Class CommentManager
     * est = ou != à l'utilisateur en SESSION
     * */
    public function userHasReported ($commentId) {

        $commentManager = New CommentManager();
        $userAcusser = $_SESSION['user'];

        $userDB = $commentManager -> userHasReported($commentId);

        if($userDB === $userAcusser) {
            return true;
        }

        return false;
    }
}