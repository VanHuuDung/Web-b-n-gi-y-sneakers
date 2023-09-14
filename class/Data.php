<?php
class Data
{
    public function getConn()
    {
        $db_host = 'localhost';
        $db_name = 'db_sneaker';
        $db_user = 'mydb_sneaker';
        $db_pass = 'Fn_ZhzbQXYE)]CfZ';

        // $db_host = 'sql312.epizy.com';
        // $db_name = 'epiz_34264748_db_sneaker';
        // $db_user = 'epiz_34264748';
        // $db_pass = 'VOPNlrVYMC';

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

        return new PDO($dsn, $db_user, $db_pass);
    }

    public function insert($Name, $Image, $Gendersid, $Desc, $Price, $PriceDiscount, $Showonhomepage, $Brandsid)
    {
        $pdo = $this->getConn();
    
        // INSERT INTO `products`(`ProductsName`, `Avatar`, `GendersId`, `FullDescription`, `Price`, `PriceDiscount`, `ShowOnHomePage`, `BrandsId`) 
        // VALUES (:name, :image, :gendesrid, :desc, :price, :pricediscount, :showonhomepage, :brandsid)

        // $sql = "INSERT INTO `product`(`name`, `desc`, `price`, `image`) VALUES (:name, :desc, :price, :image)"; 
        $sql = "INSERT INTO `products`(`ProductsName`, `Avatar`, `GendersId`, `FullDescription`, `Price`, `PriceDiscount`, `ShowOnHomePage`, `BrandsId`) 
        VALUES (:name, :image, :gendersid, :desc, :price, :pricediscount, :showonhomepage, :brandsid)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $Name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $Image, PDO::PARAM_STR);
        $stmt->bindParam(':gendersid', $Gendersid, PDO::PARAM_INT);
        $stmt->bindParam(':desc', $Desc, PDO::PARAM_STR);
        $stmt->bindParam(':price', $Price, PDO::PARAM_INT);
        $stmt->bindParam(':pricediscount', $PriceDiscount, PDO::PARAM_INT);
        $stmt->bindParam(':showonhomepage', $Showonhomepage, PDO::PARAM_INT);
        $stmt->bindParam(':brandsid', $Brandsid, PDO::PARAM_INT);

        if($stmt->execute()){
            $id = $pdo->lastInsertId();
            return $id;
        }else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }



    public function update($Name, $Image, $Gendersid, $Desc, $Price, $PriceDiscount, $Showonhomepage, $Brandsid, $id)
    {
        $pdo = $this->getConn();
    
        $sql = "UPDATE `products` SET `ProductsName`=:name,`Avatar`=:image,`GendersId`=:gendersid,`FullDescription`=:desc,`Price`=:price,`PriceDiscount`=:pricediscount,`ShowOnHomePage`=:showonhomepage,`BrandsId`=:brandsid WHERE ProductsId = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $Name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $Image, PDO::PARAM_STR);
        $stmt->bindParam(':gendersid', $Gendersid, PDO::PARAM_INT);
        $stmt->bindParam(':desc', $Desc, PDO::PARAM_STR);
        $stmt->bindParam(':price', $Price, PDO::PARAM_INT);
        $stmt->bindParam(':pricediscount', $PriceDiscount, PDO::PARAM_INT);
        $stmt->bindParam(':showonhomepage', $Showonhomepage, PDO::PARAM_INT);
        $stmt->bindParam(':brandsid', $Brandsid, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return true;
        }else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

    public function delete($id)
    {
        $pdo = $this->getConn();

        $sql = "DELETE FROM `products` WHERE ProductsId = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

}