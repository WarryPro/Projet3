<?php 

namespace Models;

require_once('Manager.php');


use Controllers\SessionController;
use entity\User;

class UserManager extends Manager {
    
    protected $bdd;

    public function __construct($bdd) {

        $this -> setBDD($bdd);
    }

    public function setBDD($bdd) {
        $this -> bdd = $bdd;
    }

    public function getInfos() {

        $bdd = $this -> dbConnect();
        $requete = $bdd -> query('SELECT * FROM users');
        $requete -> setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\User');
        $user = $requete -> fetchAll();

        return $user;
    }

    public function getUsers() {

        $bdd = $this->dbConnect();

        // Recupere la liste d'utilisateurs
        $req = $bdd->query('SELECT `id`, `user`, `email`, `user_role` FROM users ORDER BY id DESC');

        return $req;
    }

    public function getUser($userId) {

        $bdd = $this->dbConnect();
        $req = $bdd->query("SELECT `id`, `user`, `email`, `pass`, `user_role` FROM users WHERE id = $userId");

        $user = $req -> fetch();

        return $user;

    }

    public function setInfos(User $user) {

        $bdd = $this -> dbConnect();
        $requete = $bdd -> prepare('UPDATE users SET user = :user, email = :email, user_role = :user_role WHERE id = :id');

        $requete -> bindValue(':user', $user -> getUser());
        $requete -> bindValue(':email', $user -> getEmail());
        $requete -> bindValue(':user_role', $user -> getUserRole());
        $requete -> bindValue(':id', $user -> getId());

        $requete -> execute();

        $infos = $requete;

        return $infos;
    }


    public function updateUser(User $user) {

        $bdd = $this -> dbConnect();

        $userId = $user->getId();

        $reqPass = $bdd -> query("SELECT pass FROM users WHERE id = $userId ");

        $reqPass->setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\User');

        $userPassDb = '';

        $userPass = $reqPass -> fetch(\PDO::FETCH_ASSOC);

        if($reqPass -> rowCount() > 0) {
            $userPassDb = $userPass['pass'];
        }

        $req = $bdd -> prepare("UPDATE `users` SET `user` = :user,  `email` = :email, `pass` = :pass, `user_role` = :user_role WHERE `id` = :id ");


        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin') {


            $req -> setFetchMode(\PDO::FETCH_PROPS_LATE | \PDO::FETCH_CLASS, '\entity\User');

            $req -> fetch(\PDO::FETCH_ASSOC);

            $passIn = (!empty($user -> getPass())) ? password_hash($user -> getPass(), PASSWORD_DEFAULT) : $userPassDb; //encriptation du mdp donné par @user si != a null sinon on donne le mdp de la BDD

            // Vérif mdp hashé donné par @user et le compare avec le mdp récuperé de la BDD
            if(password_verify($passIn, $userPassDb)) {
                $req -> bindValue( ':id', $userId);
                $req -> bindValue( ':user', $user -> getUser());
                $req -> bindValue( ':email', $user -> getEmail());
                $req -> bindValue( ':pass', $userPassDb);
                $req -> bindValue( ':user_role', $user -> getRole());

                $req -> execute();

                return true;
            }
            else {
                $req -> bindValue( ':id', $userId);
                $req -> bindValue( ':user', $user -> getUser());
                $req -> bindValue( ':email', $user -> getEmail());
                $req -> bindValue( ':pass', $passIn);
                $req -> bindValue( ':user_role', $user -> getRole());

                $req -> execute();

                return true;
            }
        }
        else {
            echo "Erreur au momment de mettre à jour l'utilisateur, il faut se connecter en tant qu'admin...";
            return false;
        }
    }


    /**
     * @param User $user envoyé depuis le UserController -> deleteUser(User $user)
     */
    public function deleteUser(User $user) {

        $sessionController = New SessionController();
        $sessionUser = $sessionController->getSessionRole();

        $bdd = $this -> dbConnect();

        if(isset($sessionUser) && $sessionUser === "Admin") {

            $req = $bdd -> prepare("DELETE FROM `users` WHERE id = :id LIMIT 1");

            $req -> bindValue(':id', $user->getId());

            $req -> execute();

            return true;
        }

        return false;
    }


    /*
     * @var $passIn : recois le mdp envoyé par l'utilisateur (dans le fichier index.php)
     * @return true si la requete a au moin une ligne et si le mdp inseré est le même que celui de la bdd, false sinon
     * */
    public function connUser(User $user) {

        $bdd = $this -> dbConnect();

        $passIn = $user -> getPass(); // mdp donné pour @user

        $requete = $bdd -> prepare('SELECT * FROM users WHERE user = :user LIMIT 1'); // selectionne l'user passé en @param

        $requete -> execute(array(':user' => $user -> getUser())); // Recuperer les valeurs de la BDD dans un array pour l'utilisateur passé en @param

        $userRow = $requete -> fetch(\PDO::FETCH_ASSOC);

        if($requete -> rowCount() > 0) {

            // Vérif mdp à hasher donné par @user et le compare avec le mdp récuperé de la BDD
            if(password_verify($passIn, $userRow['pass'])) {

                return true;
            }
            return false;
        }
    }

    /*
     * Si l'utilisateur @user -> getUser() (dans le login) a le role Admin
     * return true sinon donc false
     * */
    public function isAdmin(User $user) {

        $bdd = $this -> dbConnect();

        $requete = $bdd -> prepare('SELECT * FROM users WHERE user = :user LIMIT 1'); // selectionne l'user passé en @param

        $requete -> execute(array(':user' => $user -> getUser())); // Recuperer les valeurs de la BDD dans un array pour l'utilisateur passé en @param

        $userRow = $requete -> fetch(\PDO::FETCH_ASSOC);

        if($requete -> rowCount() > 0) {

            if($userRow['user_role'] === "Admin") {
                $_SESSION['user_role'] = $userRow['user_role'];
                return true;
            }

            $_SESSION['user_role'] = $userRow['user_role'];
            return false;
        }
    }


    /*
     * Méthode pour inscrire un nouvel utilisateur
     * @user à inscrire
     * */
    public function inscrUser(User $user) {

        $bdd = $this -> dbConnect();

        $hash = password_hash($user -> getPass(), PASSWORD_DEFAULT); //encriptation du mdp donné par @user

        $requete = $bdd -> prepare("INSERT INTO users(user, email, pass, user_role) VALUES(:user, :email, :pass, 'User')");

        $requete -> bindValue(':user', $user -> getUser());

        $requete -> bindValue(':email', $user -> getEmail());

        $requete -> bindValue(':pass', $hash);

        $requete -> execute();


        return $addUser = $requete;
    }


    public function updatePass(User $user) {

        $bdd = $this -> dbConnect();
        $hash = password_hash($user -> getPass(), PASSWORD_DEFAULT);

        $req = $bdd -> prepare('UPDATE users SET pass = :pass WHERE id = :id');

        $req -> bindValue(':id',$user -> getId());
        $req -> bindValue(':pass',$hash);

        $req -> execute();
    }
}