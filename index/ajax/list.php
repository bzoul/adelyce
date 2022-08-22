<?php
$action = isset($_POST['action']) ? $_POST['action'] : "" ;

switch ($action) {
    case 'all':
        $listObjects = [['pain', 1, 'du pain'],['lait', 2, 'brique de lait candy'],['beurre', 18, 'car la bretagne'], ['soja', 1, 'pour le vegan']];
        break;
    case 'sharWithMe':
        break;
    case 'sharByMe':
        break;
}
$listObjects = [['pain', 1, 'du pain'],['lait', 2, 'brique de lait candy'],['beurre', 18, 'car la bretagne'], ['soja', 1, 'pour le vegan']];
foreach ($listObjects as $listObject) {
    listObject ($listObject[0],$listObject[1],$listObject[2]);
}


function listObject ($name, $number, $description) {
    echo '<div class="listObjectContainer">';
        echo '<div class="mainInfoContainer">';
            echo '<div class="listObjectName">';
                echo $name;
            echo '</div>';
            echo '<div class="listObjectNumber">x';
                echo $number;
            echo '</div>';
        echo '</div>';
        echo '<div class="listObjectDescription">';
            echo $description;
        echo '</div>';
        echo '<div class="listObjectButton">';
            echo '<button>Edit</button>';
            echo '<button>Share</button>';
            echo '<button>Delete</button>';
        echo '</div>';
    echo '</div>';
}


?>