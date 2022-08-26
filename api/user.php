<?php
require_once 'bdd.php';

class User 
{
    public $id;
    public $email;
    public $firstname;
    public $lastname;
    public $password;


    function __get ($property) {
        switch ($property) {
            case 'login':
                return $this->login();
                break;
            case 'register':
                return $this->register();
                break;
            case 'getUser':
                return $this->getUserId();
                break;
            case 'getByMail':
                return $this->getByMail();
                break;
            case 'getById':
            return $this->getById();
            break;
        }
    }

    private function login () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT id, email, lastname, firstname, password
            FROM public."user" WHERE "email" = \'' . $this->email .'\' AND "password" = \'' . $this->password . '\'');
        $ligne = $var->fetch();
        if ($ligne) {
            return true;
        } else {
            return false;
        }
    }

    private function register () {
        if ($this->uniqueMail()) {
            return 'email already taken';
        } else {
            $pdo = Database::getConnection();
            $var  = $pdo->query('INSERT INTO public."user"(
                email, lastname, firstname, password)
            VALUES ( \'' . $this->email . '\', \'' . $this->lastname . '\', \'' . $this->firstname . '\', \'' . $this->password . '\');');
            $ligne = $var->fetch();
            return true;
        }
        
    }

    private function getUserId () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT id, email, lastname, firstname, password
            FROM public."user" WHERE "email" = \'' . $this->email .'\' AND "password" = \'' . $this->password . '\'');
        $ligne = $var->fetch();
        return $ligne['id'];
    }

    private function getByMail () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT id, email, lastname, firstname, password
            FROM public."user" WHERE "email" = \'' . $this->email .'\'');
        $ligne = $var->fetch();
        return $ligne;
    }

    private function uniqueMail () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT  email
            FROM public."user" WHERE "email" = \'' . $this->email .'\'');
        $ligne = $var->fetch();
        return $ligne;
    }

    private function getById () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT  email
            FROM public."user" WHERE "id" = \'' . $this->id .'\'');
        $ligne = $var->fetch();
        return $ligne;
    }
}
?>