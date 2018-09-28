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


    /*
     * @var $passIn : recois le mdp envoyé par l'utilisateur (dans le fichier index.php)
     * @return true si la requete a au moin une ligne et si le mdp inseré est le même que celui de la bdd, false sinon
     * */
    public function connUser(User $user) {

        $db = $this -> dbConnect();

        $passIn = $user -> getPass();

        $requete = $db -> prepare('SELECT * FROM users WHERE user = :user LIMIT 1');

        $requete -> execute(array(':user' => $user -> getUser()));

        $userRow = $requete -> fetch(\PDO::FETCH_ASSOC);

        if($requete -> rowCount() > 0) {

            if(password_verify($passIn, $userRow['pass'])) {

                return true;
            }
            else {
                return false;
            }
        }
    }



    public function inscrUser(User $user) {

        $db = $this -> dbConnect();

        $hash = password_hash($user -> getPass(), PASSWORD_DEFAULT);

        $requete = $db -> prepare("INSERT INTO users(user, email, pass, user_role) VALUES(:user, :email, :pass, 'User')");

        $requete -> bindValue(':user', $user -> getUser());

        $requete -> bindValue(':email', $user -> getEmail());

        $requete -> bindValue(':pass', $hash);

        $requete -> execute();


        return $addUser = $requete;
    }


    public function updatePass(User $user) {

        $db = $this -> dbConnect();
        $hash = password_hash($user -> getPass(), PASSWORD_DEFAULT);

        $req = $db -> prepare('UPDATE users SET pass = :pass');

        $req -> bindValue(':pass',$hash);

        $req -> execute();
    }
}