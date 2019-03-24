<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 29/12/2018
 * Time: 00:34
 */

namespace entity;


class Post {
    protected $idPost;
    protected $title;
    protected $content;
    protected $image;

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


    /*
     * GETTERS
     **/
    public function getIdPost() {

        return $this -> idPost;
    }

    public function getTitle() {

        return $this -> title;
    }


    public function getContent() {

        return $this -> content;
    }

    public function getImage() {

        return $this -> image;
    }



    /*
     * SETTERS
     **/
    public function setIdPost($idPost) {

        $this -> idPost = $idPost;
    }

    public function setTitle($title) {

        $this -> title = $title;
    }

    public function setContent($content) {

        $this -> content = $content;
    }

    public function setImage($image) {

        $this -> image = 'public/images/' . $image;
    }

}