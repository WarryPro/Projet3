<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:07
 */

namespace Models;


class PaginationManager extends Manager {
    private $db,
            $table,
            $totalRecords,
            $limit = 5,
            $col;


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

//    TODO:  à voir
    public function setTotalRecords() {

        $query = "SELECT id FROM $this -> table";
    }
}