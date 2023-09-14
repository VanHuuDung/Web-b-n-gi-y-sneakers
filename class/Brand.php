<?php

class Brand
{
    public $BrandsId; 
    public $BrandsName;

    public function __construct($BrandsId = 0, $BrandsName = '')
    {
        $this->BrandsId = $BrandsId;
        $this->BrandsName = $BrandsName;
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
                $product = new Brand($row['BrandsId'], $row['BrandsName']);
                $product->BrandsId = $row['BrandsId'];
                $product->BrandsName = $row['BrandsName'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public static function getGender()
    {
        $data = [];

        $db = new Data();
        $pdo = $db->getConn();

        $sql = "SELECT * FROM `genders`";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Brand($row['GendersId'], $row['GenderName']);
                $product->BrandsId = $row['GendersId'];
                $product->BrandsName = $row['GenderName'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
}