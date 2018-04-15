<?php
/**
 * Created by PhpStorm.
 * User: shizhu
 * Date: 2018-04-12
 * Time: 10:50 PM
 */

class DBConnection
{
    protected $connection;

    public function getConnInstant()
    {
        if (!isset($this->connection)) {
            $this->connection = new PDO("mysql:host=localhost;dbname=iShop;charset=utf8mb4", "root", "root");
        }
        return $this->connection;
    }

    public function addToStore($goodsname, $goodsprice, $goodsimage_url, $goodsdescription)
    {
        //TODO : ADD CHECK -

        // ADD TO DB
        $stmt = $this->getConnInstant()->prepare("INSERT INTO item (name,price,image_url,description) VALUES (:name, :price, :image_url, :description)");
        $result = $stmt->execute(
            array(
                ':name' => $goodsname,
                ':price' => $goodsprice,
                ':image_url' => $goodsimage_url,
                ':description' => $goodsdescription
            )
        );
        return $result;
    }

    public function getAllStoregoods()
    {
        $stmt = $this->getConnInstant()->query("SELECT * FROM item");
        $StoreGoods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //TODO : ARRAY TO OBJECT MODEL


        $result = array();
        foreach ($StoreGoods as $ggg) {
            $temp = array(
                'gname' => $ggg['name'],
                'gprice' => $ggg['price'],
                'gimage_url' => $ggg['image_url'],
                'gdescription' => $ggg['description'],
                'gid' => $ggg['id']
            );
            $result[] = $temp;

        }
        return $result;
    }


/*
 * after testing, until now we can run it.
     $db = new DBConnection();
     $sth = $db->getAllStoregoods();
     var_dump($sth);
*/

    public function getGoodsById($id){
        $stmt = $this->getConnInstant()->prepare("SELECT * FROM item where id = :id");
        $stmt->execute(
            array(
                ':id' => $id,
            )
        );

        $StoreGood = $stmt->fetch();
        $result = array(
            'gname' => $StoreGood['name'],
            'gprice' => $StoreGood['price'],
            'gimage_url' => $StoreGood['image_url'],
            'gdescription' => $StoreGood['description'],
            'gid' => $StoreGood['id']
        );

        return $result;
    }






}




?>