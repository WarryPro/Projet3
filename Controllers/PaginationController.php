<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:04
 */

namespace Controllers;

use entity\Pagination;
use Models\PaginationManager;

class PaginationController {


    /**
     * @param Pagination $pagination prend les valeurs passées par les variables GET
     * dans le routeur/page implémentée
     */
    public function pagination (Pagination $pagination) {

        $paginationManager = New PaginationManager();

        $viewController = New ViewController();
        $totalElmts = $paginationManager -> paginationTotalElms($pagination);

        $totalPages = ceil($totalElmts / $pagination -> getPostsParPage());

        $posts = $paginationManager -> pagination ($pagination);


        $table = $pagination -> getTable();
        $page= $pagination -> getPage();
        $action = (isset($_GET['action'])) ? filter_var( $_GET['action'], FILTER_SANITIZE_STRIPPED) : NULL;

        $method = 'listEpisodesAdmin';

        if($action !== 'admin') {

            $method = 'list'.ucfirst($table);
        }

        $data = [$totalPages, $posts, $page];

        $viewController -> $method($data);

    }
}