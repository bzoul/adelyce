<?php
session_start();
if (!$_SESSION['login']) {
    var_dump($_SESSION['login']) ;
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <link rel="stylesheet" href="css/list.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="js/list.js"></script>
</head>
<body>
    <div id="topContainer">
        <h1>ceci est mon titre</h1>
        <button id="discoButton">disconected</button>
    </div>
    <div id="mainContainer">
        <div id="barChoise">
            <div class="buttonChoise" id="selectedChoise" value="all">All</div>
            <div class="buttonChoise" value="sharWithMe">Share with me</div>
            <div class="buttonChoise" value="sharByMe">Share by me</div>
        </div>
        <div id="buttonAddContainer">
            <button id="buttonAdd">Add</button>
        </div>
        <div id="listContainer">

        </div>
    </div>
    <div class="dialog" id="dialogAdd" title="Add to my list">
        <div class="dialogContainer">
            <div class="dialogObjectInfo">
                <div>Name</div>
                <input id="nameProduct" type="text">
                <div>Number</div>
                <input id="numberProduct" type="text">
            </div>
            <div>Description</div>
            <textarea name="description" id="descriptionProduct" cols="30" rows="10"></textarea>
            <button class="buttonDialog" id="addProduct">Validate</button>
        </div>
    </div>
    <div class="dialog" id="dialogModify" title="Modify my product">
        <div class="dialogContainer">
            <div class="dialogObjectInfo">
                <div>Name</div>
                <input id="modifyProductName" type="text">
                <div>Number</div>
                <input id="modifyProductNumber" type="text">
            </div>
            <div>Description</div>
            <textarea name="description" id="modifyProductDescription" cols="30" rows="10"></textarea>
            <button class="buttonDialog" id="modifyProduct">Modify</button>
        </div>
    </div>
    <div class="dialog" id="dialogShare" title="Share my product">
        <div class="dialogContainer">
            <div class="dialogObjectInfo">
                <div>email</div>
                <input id="emailForShare" type="email">
            </div>
            <button class="buttonDialog" id="shareProduct">Share</button>
        </div>
    </div>
</body>
</html>
