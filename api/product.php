<?php
require_once 'bdd.php';

class Product 
{
    public $id;
    public $description;
    public $quantity;
    public $name;
    public $idUser;

    function __get ($property) {
        switch ($property) {
            case 'addProduct':
                return $this->addProduct();
                break;
            case 'getAllProduct':
                return $this->getAllProduct();
                break;
            case 'deleteProduct':
                return $this->deleteProduct();
                break;
            case 'modifyProduct':
                return $this->modifyProduct();
                break;
            case 'bindById':
                return $this->bindById();
                break;
        }
    }

    public static function getProductById($id) {
        $pdo = Database::getConnection();
        $var  = ('SELECT id, name, quantity, description
        FROM public.product WHERE "id" = ' . $id .'');
        $ligne = $var->fetch();
        return $ligne;
    }

    private function addProduct () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('INSERT INTO public.product(
            name, quantity, description, id_user)
            VALUES (\'' . $this->name . '\', ' . $this->quantity . ', \'' . $this->description . '\', ' . $this->idUser . ');');
        $ligne = $var->fetch();
        return $ligne;
    }

    private function getAllProduct () {
        $result = [];
        $pdo = Database::getConnection();
        $var  = ('SELECT id, name, quantity, description
        FROM public.product WHERE "id_user" = ' . $this->idUser .'');
        foreach ($pdo->query($var) as $row) {
            array_push($result,$row);

        }
        return ($result);
    }

    private function deleteProduct () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('DELETE FROM public.product
        WHERE "id" = ' . $this->id . '');
        $ligne = $var->fetch();
    }

    private function modifyProduct () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('UPDATE public.product
        SET name=\'' . $this->name . '\', quantity=' . $this->quantity . ', description=\'' . $this->description . '\'
        WHERE "id" = ' . $this->id . ';');
        $ligne = $var->fetch();
        return $ligne;
    }

    private function bindById () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT name, quantity, description, id_user
        FROM public.product WHERE "id" = ' . $this->id .'');
        $ligne = $var->fetch();
        return ($ligne);
    }
}
?>