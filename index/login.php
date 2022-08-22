<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <input class="inputConnect" type="text" placeholder="e-mail">
                <input class="inputConnect" type="text" placeholder="password">
            </div>
            <div class="buttoncontainer">
                <button id="register">Register</button>
                <button>Connection</button>
            </div>
        </div>
        <div class="infoContainer" id="registerContainer">
            <h3>REGISTER</h3>
            <div class="inputContainer">
                <input class="inputConnect" type="text" placeholder="e-mail">
                <input class="inputConnect" type="text" placeholder="firstname">
                <input class="inputConnect" type="text" placeholder="lastname">
                <input class="inputConnect" type="text" placeholder="password">
            </div>
            <div class="buttoncontainer">
                <button id="login">Return</button>
                <button>Connection</button>
            </div>
        </div>
    </div>
</body>
</html>