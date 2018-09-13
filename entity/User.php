<?php

namespace entity;

class User {

    protected $id;
	protected $user;
	protected $email;
	protected $pass;
    
    
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
    

    //getters
	
	public function getId() {
        
        return $this -> id;
    }
    

	public function getUser() {

		return $this -> user;
    }
    

	public function getEmail() {
        
        return $this -> email;
	}
    
    
    public function getPass() {
        
        return $this -> pass;
    }
    
    

	//setters
	public function setId($id) {
        
        $this -> id = $id;
    }
    

	public function setuser($user) {
        
        $this -> user = $user;
    }
    

	public function setEmail($email) {

		$this -> email = $email;
    }
    

	public function setPass($pass) {
	
		$this -> pass = $pass;
	}
	
}