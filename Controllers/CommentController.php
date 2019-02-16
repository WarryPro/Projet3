<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:23
 */

namespace Controllers;
use \Models\CommentManager;
use \entity\ReportComment;

class CommentController {

    //TODO: signaler un commentaire
    public function reportComment(ReportComment $report) {

        $commentManager = New CommentManager();
//        $uri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $reportComment = $commentManager -> reportComment($report);

        if($reportComment === FALSE) {

            echo "Une erreur est survenu";
        }
        else {
            $sessionControler = New SessionController();
            $sessionControler->setFlash('Le commentaire a été signalé', 'success');
            header('location: ../index.php?action=post&id='. $_SESSION['uri']);
            unset($_SESSION['uri']); // Supp la session pour cette var
        }
    }
}