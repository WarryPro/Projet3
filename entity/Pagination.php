<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:07
 */

namespace entity;


class Pagination {
    protected
            $table,
            $page,
            $postsParPage;


    function __construct($donnee =[]) {

        $this -> hydrate($donnee);
    }


    public function hydrate($donnee = []) {

        foreach ($donnee as $key => $value) {

            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {

                $this -> $method($value);
            }
        }
    }

    /**
     * @return string le nom du tableau dans la bdd
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param $table le nom du tableau dans la bdd
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return int le nombre de la page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int le nombre d'épisodes par page
     */
    public function getPostsParPage()
    {
        return $this->postsParPage;
    }

    /**
     * @param int $postsParPage le nombre d'épisodes par page
     */
    public function setPostsParPage($postsParPage)
    {
        $this->postsParPage = $postsParPage;
    }

}