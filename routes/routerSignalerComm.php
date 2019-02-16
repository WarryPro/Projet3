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

use \Controllers\CommentController;
use \entity\ReportComment;

Autoloader::register();
\Controllers\Autoloader::register();
\Models\Autoloader::register();
\entity\Autoloader::register();



if (!empty($_POST['commid'])){

    $commentController = New CommentController();

    $reportComment = New ReportComment(['id' => '0','commentId' => $_POST['commid'], 'userAccuser' => $_SESSION['user']]);

    $commentController -> reportComment($reportComment);

    echo  json_encode($_POST['commid']);
}
else {
    echo json_encode('Une erreur est survenu...');
}
