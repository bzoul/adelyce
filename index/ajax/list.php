<?php
session_start();
require '../../api/product.php';
require '../../api/user.php';
require '../../api/share.php';
$action = isset($_POST['action']) ? $_POST['action'] : "" ;
switch ($action) {
    case 'all':
        printMyProduct();
        printProductShareToMe();
        break;
    case 'shareWithMe':
        printProductShareToMe();
        break;
    case 'shareByMe':
        printProductShareByMe();
        break;
    case 'delete':
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $shareByMe = new Share();
        $shareByMe->shareBy = $_SESSION['loginId'];
        $shareByMe->idProduct = $id;
        var_dump($shareByMe->deleteShareByMe);
        $product = new Product();
        $product->id = $id;
        var_dump($product->deleteProduct);
        break;
    case 'modify':
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $quantity = isset($_POST['number']) ? $_POST['number'] : "";
        $description = isset($_POST['description']) ? $_POST['description'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $product = new Product();
        $product->name = $name;
        $product->quantity = $quantity;
        $product->description = $description;
        $product->id = $id;
        $product->modifyProduct;
        break;
    case 'addProduct':
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $quantity = isset($_POST['number']) ? $_POST['number'] : "";
        $description = isset($_POST['description']) ? $_POST['description'] : "";
        $product = new Product();
        $product->name = $name;
        $product->quantity = $quantity;
        $product->description = $description;
        $product->idUser = $_SESSION['loginId'];
        if (strlen($product->name) < 50 && strlen($product->quantity) < 50 ) {
            $add = ($product->addProduct);
            echo 'success';
        } else {
            echo 'name or number too long';
        }
        break;
    case 'share':
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : "";
        $userToShare = new User();
        $userToShare->email = $email;
        $userToShare = $userToShare->getByMail;
        if ($userToShare) {
            $userToShareId = $userToShare['id'];
            $userShareBy = $_SESSION['loginId'];
            if ($userShareBy != $userToShareId) {
                $share = new Share();
                $share->shareTo = $userToShareId;
                $share->idProduct = $idProduct;
                $share->shareBy = $userShareBy;
                echo ($share->shareToUser);
            } else {
                echo 'can \'t share to yourself';
            }

        } else {
            echo ('user not found');
        } 
        break;
    case 'deleteShare':
        $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : "";
        $idUser = $_SESSION['loginId'];
        $share = new Share();
        $share->shareTo = $idUser;
        $share->idProduct = $idProduct;
        var_dump($share->deleteShareToMe);
        break;
    case 'unshareProduct':
        $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : "";
        $idUser = $_SESSION['loginId'];
        $share = new Share();
        $share->shareBy = $idUser;
        $share->idProduct = $idProduct;
        var_dump($share->deleteShareByMe);
        break;
}


function getProductShareToMe () {
    $share = new Share();
    $share->shareTo = $_SESSION['loginId'];
    $listProductShareToMe = $share->shareToMe;
    return ($listProductShareToMe);
}

function getProductShareByMe () {
    $share = new Share();
    $share->shareBy = $_SESSION['loginId'];
    $listProductShareByMe = $share->shareByMe;
    return ($listProductShareByMe);
}

function printProductShareByMe () {
    echo '<h3 class="currentStateList">Share By Me </h3>';
    $listIdProductShareByMe = getProductShareByMe();
    foreach ($listIdProductShareByMe as $idProductShareByMe) {
        $productShareByMe = new Product ();
        $productShareByMe->id = $idProductShareByMe[0];
        $productShare = $productShareByMe->bindById;
        $userWhoShare = new User();
        $userWhoShare->id = $productShare['id_user'];
        $emailUser = $userWhoShare->getById;
        listObjectShareByMe($emailUser['email'], $idProductShareByMe[0], $productShare['name'],$productShare['quantity'],$productShare['description']);
    }
}

function printProductShareToMe () {
    echo '<h3>Share With Me </h3>';
    $listIdProductShareToMe = getProductShareToMe();
    foreach ($listIdProductShareToMe as $idProductShareToMe) {
        $productShareToMe = new Product ();
        $productShareToMe->id = $idProductShareToMe[0];
        $productShare = $productShareToMe->bindById;
        $userWhoShare = new User();
        $userWhoShare->id = $productShare['id_user'];
        $emailUser = $userWhoShare->getById;
        listObjectShareToMe($emailUser['email'], $idProductShareToMe[0], $productShare['name'],$productShare['quantity'],$productShare['description']);
    }
}

function printMyProduct () {
    echo '<h3 class="currentStateList">My List </h3>';
    $product = new Product();
    $product->idUser = $_SESSION['loginId'];
    $productList = $product->getAllProduct;
    foreach ($productList as $prod) {
        listObject($prod['id'],$prod['name'],$prod['quantity'],$prod['description']);
    }
}

function listObject ($id, $name, $number, $description) {
    echo '<div class="listObjectContainer" ">';
        echo '<div class="mainInfoContainer">';
            echo '<div class="listObjectName">';
                echo $name;
            echo '</div>';
            echo '<div class="listObjectNumber">';
                echo $number;
            echo '</div>';
        echo '</div>';
        echo '<div class="listObjectDescription">';
            echo $description;
        echo '</div>';
        echo '<div class="listObjectButton" id="' . $id . '">';
            echo '<button id="editProduct" onclick="list.modifyProductDialog(this);">Edit</button>';
            echo '<button id="shareProduct" onclick="list.shareProductDialog(this);">Share</button>';
            echo '<button id="deleteProduct" onclick="list.deleteProduct(this);">Delete</button>';
        echo '</div>';
    echo '</div>';
}

function listObjectShareToMe ($email, $id, $name, $number, $description) {
    echo '<div class="listObjectContainer" ">';
        echo '<h4>Share by ' . $email . '</h4>';
        echo '<div class="mainInfoContainer">';
            echo '<div class="listObjectName">';
                echo $name;
            echo '</div>';
            echo '<div class="listObjectNumber">';
                echo $number;
            echo '</div>';
        echo '</div>';
        echo '<div class="listObjectDescription">';
            echo $description;
        echo '</div>';
        echo '<div class="listObjectButton" id="' . $id . '">';
            echo '<button id="deleteShareProduct" onclick="list.deleteShareProduct(this);">Delete</button>';
        echo '</div>';
    echo '</div>';
}

function listObjectShareByMe ($email, $id, $name, $number, $description) {
    echo '<div class="listObjectContainer" ">';
        echo '<div class="mainInfoContainer">';
            echo '<div class="listObjectName">';
                echo $name;
            echo '</div>';
            echo '<div class="listObjectNumber">';
                echo $number;
            echo '</div>';
        echo '</div>';
        echo '<div class="listObjectDescription">';
            echo $description;
        echo '</div>';
        echo '<div class="listObjectButton" id="' . $id . '">';
            echo '<button id="unshareShareProduct" onclick="list.unshareShareProduct(this);">Unshare</button>';
            echo '<button id="deleteShareProduct" onclick="list.deleteProduct(this);">Delete</button>';
        echo '</div>';
    echo '</div>';
}

?>