<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 26/02/2019
 * Time: 21:46
 */

namespace Models;


use entity\Pagination;

class PaginationManager extends Manager {

    public function paginationTotalElms (Pagination $pagination) {

        $bdd = self::dbConnect();

        $table = $pagination -> getTable();


        $req = $bdd -> query("SELECT COUNT(id) AS total FROM $table");

        $result = $req -> fetch()['total']; // total elements dans le tableau

        return (int)$result;
    }

    public function pagination (Pagination $pagination) {

        $bdd = self::dbConnect();

        $table  = $pagination -> getTable();
        $page   = (int)$pagination -> getPage();
        $postsParPage = $pagination -> getPostsParPage();
        $start = ($page > 0) ? $page * $postsParPage - $postsParPage : 0;

        $req = $bdd -> query("SELECT SQL_CALC_FOUND_ROWS * FROM $table ORDER BY id DESC LIMIT $start,$postsParPage");

        if($table = 'episodes') {

            $req = $bdd -> query("SELECT SQL_CALC_FOUND_ROWS id, title, content, image_episode, DATE_FORMAT(created_date, '%d/%m/%Y') AS created_date_fr FROM $table ORDER BY id DESC LIMIT $start,$postsParPage");
        }

        $result = $req -> fetchAll();

        return $result;
    }
}