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

            if($reportComment) {
                $sessionController->setFlash('Le commentaire a été signalé avec succès!', 'success');
                header('location: ../index.php?action=post&id='. $_SESSION['uri']);
                unset($_SESSION['uri']); // Supp la session pour cette var
            }
        }

        else {
//      si il a déjà signalé avant alors en envoie une alerte
            $sessionController->setFlash('Vous avez déjà signalé ce commentaire...', 'error');
            header('location: ../index.php?action=post&id='. $_SESSION['uri']);
            unset($_SESSION['uri']); // Supp la session pour cette var

        }
    }


    public function validateComment(ReportComment $comment) {

        $commentManager = New CommentManager();
        $sessionController = New SessionController();
        $validedComment = $commentManager -> validateComment($comment);

        if(!$validedComment) {

            throw new \Exception('Une erreur est survenue...');
        }

        $sessionController -> setFlash('Le commentaire a été validé avec succès!', 'success');
        header('Location: index.php?action=admin');
    }

    /*
     * Return un bool si l'utilisateur returné par la méthode userHasReported de la Class CommentManager
     * est = ou != à l'utilisateur en SESSION
     * */
    public function userHasReported ($commentId) {

        $commentManager = New CommentManager();
        $sessionController = New SessionController();

        $userAcusser = $sessionController -> getCurrentUser();

        $userDB = $commentManager -> userHasReported($commentId);

        if($userDB === $userAcusser) {
            return true;
        }

        return false;
    }
}