<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 16/02/2019
 * Time: 00:40
 */
namespace routes;

session_start();


require ('../Controllers/Autoloader.php');
require ('../Models/Autoloader.php');
require ('../entity/Autoloader.php');
require ('Autoloader.php');

use Controllers\CommentController;
use Controllers\SessionController;
use entity\ReportComment;

Autoloader::register();
\Controllers\Autoloader::register();
\Models\Autoloader::register();
\entity\Autoloader::register();



if (!empty($_POST['commid'])){

    $commId = trim($_POST['commid']);

    $sessionController = New SessionController();
    $commentController = New CommentController();

    $currentUser = $sessionController ->getCurrentUser();

    $reportComment = New ReportComment(['id' => '0','commentId' => $commId, 'userAccuser' => $currentUser]);

    $commentController -> reportComment($reportComment);
}
else {
    throw new \Exception('Erreur au momment de signaler le commentaire...!');
}
