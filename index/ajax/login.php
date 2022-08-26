<?php
session_start();
require '../../api/user.php';
$action = isset($_POST['action']) ? $_POST['action'] : "" ;

switch ($action) {
    case 'login':
        $login = isset($_POST['login']) ? $_POST['login'] : "" ;
        $password = isset($_POST['password']) ? $_POST['password'] : "" ;
        if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
            echo 'invalid email';
        } else {
            $user = new user();
            $user->email = $login;
            $user->password = $password;
            $connected = $user->login;
            $_SESSION['login'] = $connected;
            echo($connected ? true : false );
            $_SESSION['loginId'] = $user->getUser;
            
        }
        break;
    case 'register':
        $email = isset($_POST['email']) ? $_POST['email'] : "" ;
        $password = isset($_POST['password']) ? $_POST['password'] : "" ;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "" ;
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "" ;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'invalid email';
        } else {
            $user = new user();
            $user->email = $email;
            $user->password = $password;
            $user->lastname = $lastname;
            $user->firstname = $firstname;
            $connected = $user->register;
            // var_dump($user->getUser);
            $_SESSION['login'] = true;
            if ($connected) {
                $_SESSION['loginId'] = $user->getUser;
            }
            echo ($connected);
        }
        break;
    }
?>