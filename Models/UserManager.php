<?php 

namespace Models;

require_once('Manager.php');


use \entity\User;

class UserManager extends Manager {
    
    protected $db;

    public function __construct($db) {

        $this -> setDB($db);
    }

    public function setDB($db) {
        $this -> db = $db;
    }

    public function getInfos() {

        $db = $this -> dbConnect();
        $requete = $db -> query('SELECT * FROM users');
        $requete -> setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\User');
        $user = $requete -> fetchall();

        return $user;
    }

    public function setInfos(User $user) {

        $db = $this -> dbConnect();
        $requete = $db -> prepare('UPDATE users SET user = :user, email = :email, user_role = :user_role WHERE id = :id');

        $requete -> bindValue(':user', $user -> getUser());
        $requete -> bindValue(':email', $user -> getEmail());
        $requete -> bindValue(':user_role', $user -> getUserRole());
        $requete -> bindValue(':id', $user -> getId());

        $requete -> execute();

        $infos = $requete;

        return $infos;
    }


    public function connUser(User $user) {

        $db = $this -> dbConnect();

//        $hash = hash('sha512', $user -> getPass());

        $requete = $db -> prepare('SELECT COUNT(*) AS existe FROM users WHERE user = :user AND pass = :pass');

        $requete -> bindValue(':user', $user -> getUser());

        $requete -> bindValue(':pass', $user -> getPass());

        $requete -> execute();

        $pass = $requete -> fetch(\PDO::FETCH_ASSOC);

        $connUser = $pass['existe'];

        return $connUser;
    }


    public function updatePass(User $user) {

        $db = $this -> dbConnect();
        $hash = hash('sha512',$user->getPass());

        $req = $db -> prepare('UPDATE users SET pass = :pass');

        $req -> bindValue(':pass',$hash);

        $req -> execute();
    }
}