<?php

require 'Data.php';
class Pro
{
    public $id; 
    public $avatar;
    public $gendersId;
    public $fullDesc; 
    public $name;
    public $priceDiscount;
    public $price;
    public $showOnHomePage;
    public $brandsId;

    

    public function __construct($id = 0, $name = '', $avatar = "", $gendersId = 0, $fullDesc = '', $price = 0, 
    $priceDiscount = 0, $showOnHomePage = 0, $brandsId = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->avatar = $avatar;
        $this->gendersId = $gendersId;
        $this->fullDesc = $fullDesc; 
        $this->price = $price;
        $this->priceDiscount = $priceDiscount;
        $this->showOnHomePage = $showOnHomePage;
        $this->brandsId = $brandsId;
    }



    public static function getAll()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products`";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);

                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getNike()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE BrandsId = 1";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);

                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getAdidas()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE BrandsId = 2";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);

                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getHome()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE ShowOnHomePage = 1";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);
                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getOneByID($id)
    {
        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE ProductsId = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount'], $row['FullDescription']);
                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $product->fullDesc = $row['FullDescription'];
                $product->showOnHomePage = $row['ShowOnHomePage'];
                $data[] = $product;
                return $product;
            } else {
                return null;
            }
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getMen()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE GendersId = 1";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);
                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getWomen()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` WHERE GendersId = 2";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);
                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getPage($pdo, $limit, $offset)
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `products` ORDER BY ProductsId desc LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) { 
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['ProductsId'], $row['Avatar'], $row['Price'], $row['ProductsName'], $row['PriceDiscount']);
                $product->id = $row['ProductsId'];
                $product->avatar = $row['Avatar'];
                $product->price = $row['Price'];
                $product->name = $row['ProductsName'];
                $product->priceDiscount = $row['PriceDiscount'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getBrands()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `brands`";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Pro($row['BrandsId'], $row['BrandsName']);
                $product->id = $row['BrandsId'];
                $product->name = $row['BrandsName'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
    

}