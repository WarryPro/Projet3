<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:23
 */

namespace Controllers;
//use \Models\Manager;
use \Models\CommentManager;
use \entity\ReportComment;

class CommentController {

    //TODO: signaler un commentaire
    public function reportComment(ReportComment $report) {

        $commentManager = New CommentManager();
        $reportComment = $commentManager -> reportComment($report->getId());

        if($reportComment === FALSE) {

            echo "Une erreur est survenu";
        }
        else {
            header('location: ./index.php?action=post&id='.$report->getId());
        }
    }
}