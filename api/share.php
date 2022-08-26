<?php
require_once 'bdd.php';

class Share 
{
    public $id;
    public $shareTo;
    public $idProduct;
    public $shareBy;


    function __get ($property) {
        switch ($property) {
            case 'shareToUser':
                return $this->shareTo();
                break;
            case 'shareBy':
                return $this->getUserId();
                break;
            case 'shareToMe':
                return $this->shareToMe();
                break;
            case 'deleteShareToMe':
                return $this->deleteShareToMe();
                break;
            case 'shareByMe':
                return $this->shareByMe();
                break;
            case 'deleteShareByMe':
                return $this->deleteShareByMe();
                break;
        }
    }

    private function shareTo () {
        if ($this->alreadyExist()) {
            return 'Already share to this user';
        } else {
            $pdo = Database::getConnection();
            $var  = $pdo->query('INSERT INTO public.share(
                share_to, id_product, share_by)
                VALUES (' . $this->shareTo . ', ' . $this->idProduct . ', ' . $this->shareBy . ');');
            $ligne = $var->fetch();
        }
    }

    private function shareToMe () {
        $result = [];
        $pdo = Database::getConnection();
        $var  = ('SELECT id_product
        FROM public.share WHERE "share_to" = ' . $this->shareTo .';');
        foreach ($pdo->query($var) as $row) {
            array_push($result,$row);
        }
        return ($result);
    }

    private function alreadyExist () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('SELECT id, share_to, id_product, share_by
        FROM public.share WHERE "share_to" = ' . $this->shareTo . ' AND "id_product" = ' . $this->idProduct . ' AND "share_by" = ' . $this->shareBy . ';');
        $ligne = $var->fetch();
        return($ligne);
    }

    private function deleteShareToMe () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('DELETE FROM public.share
        WHERE "share_to" = ' . $this->shareTo . ' AND "id_product" = ' . $this->idProduct . ';');
        $ligne = $var->fetch();
        return($ligne);
    }

    private function shareByMe () {
        $result = [];
        $pdo = Database::getConnection();
        $var  = ('SELECT id_product
        FROM public.share WHERE "share_by" = ' . $this->shareBy .';');
        foreach ($pdo->query($var) as $row) {
            array_push($result,$row);
        }
        return ($result);
    }

    private function deleteShareByMe () {
        $pdo = Database::getConnection();
        $var  = $pdo->query('DELETE FROM public.share
        WHERE "share_by" = ' . $this->shareBy . ' AND "id_product" = ' . $this->idProduct . ';');
        $ligne = $var->fetch();
        return($ligne);
    }
}
?>