<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 12/02/2019
 * Time: 23:35
 */

namespace entity;


class ReportComment {
    protected   $id,
                $commentId;


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


//    GETTERS

    /**
     * @return mixed
     */
    public function getId() {

        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCommentId() {

        return $this->commentId;
    }


//    SETTERS

    /**
     * @param mixed $id
     */
    public function setId($id) {

        $this->id = $id;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId) {

        $this->commentId = $commentId;
    }
}