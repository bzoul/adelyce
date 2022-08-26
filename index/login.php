<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
    <div id="topContainer">
        <h1>Liste de course Adelyce</h1>
    </div>
    <div id="mainContainer">
        <div class="infoContainer" id="loginContainer">
            <h3>LOGIN</h3>
            <div class="inputContainer">
                <div>email:</div>
                <input id="login" class="inputConnect" type="email" placeholder="e-mail">
                <div>password:</div>
                <input id="password" class="inputConnect" type="password" placeholder="password">
            </div>
            <div class="buttoncontainer">
                <button id="register">Register</button>
                <button id="connection">Connection</button>
            </div>
        </div>
        <div class="infoContainer" id="registerContainer">
            <h3>REGISTER</h3>
            <div class="inputContainer">
                <div>email:</div>
                <input id="email" class="inputConnect" type="email" placeholder="e-mail">
                <div>firstname:</div>
                <input id="firstname" class="inputConnect" type="text" placeholder="firstname">
                <div>lastname:</div>
                <input id="lastname" class="inputConnect" type="text" placeholder="lastname">
                <div>password:</div>
                <input id="passwordRegister" class="inputConnect" type="password" placeholder="password">
            </div>
            <div class="buttoncontainer">
                <button id="returnLogin">Return</button>
                <button id="registerUser" >Connection</button>
            </div>
        </div>
    </div>
</body>
</html>