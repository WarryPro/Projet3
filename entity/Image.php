<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 21/03/2019
 * Time: 22:14
 */

namespace entity;


class Image {

    protected $path;
    protected $type;
    protected $size;
    protected $name;
    protected $tmp_name;

    /**
     * Image constructor.
     */
    public function __construct($donnee =[]) {

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
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @param mixed $tmp_name
     */
    public function setTmpName($tmp_name)
    {
        $this->tmp_name = $tmp_name;
    }

}