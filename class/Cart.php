<?php
class Cart
{
    public $ProductsName;
    public $Username;
    public $ProductsId;
    public $Price;
    public $Quantity;
    public $sosp;

    public function __construct($Id = 0, $UserName = '', $ProductId = 0, $Quantity = 0, $Price = 0, $sosp = 0)
    {
        $this->ProductsId = $Id;
        $this->Username = $UserName;
        $this->ProductsId = $ProductId;
        $this->Quantity = $Quantity;
        $this->Price = $Price;
        $this->sosp = $sosp;
    }


    public static function getAll($pdo, $username)
    {
        $data = [];

        $sql = "SELECT products.ProductsId, products.Price, products.ProductsName , UserName, cart.Quantity FROM cart, products WHERE products.ProductsId = cart.ProductsId AND cart.UserName = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $product = new Cart($row['ProductsId'], $row['UserName'], $row['Quantity']);

                $product->Username = $row['UserName'];
                $product->ProductsId = $row['ProductsId'];
                $product->Quantity = $row['Quantity'];
                $product->ProductsName = $row['ProductsName'];
                $product->Price = $row['Price'];
                $data[] = $product;
            }
            return $data;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
    public static function getOneCartByID($pdo, $username, $productsid)
    {
        $sql = "SELECT * FROM cart WHERE `UserName` = :username AND `ProductsId` = :productsid";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':productsid', $productsid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $cart = $stmt->fetch(PDO::FETCH_OBJ);
            return $cart;
        }
    }
    public static function AddtoCart()
    {
        $db = new Data();
        $pdo = $db->getConn();
        if (isset($_GET['action']) && isset($_GET['proid']) && isset($_SESSION['log_detail'])) {
            $username = $_SESSION['user'];
            $action = $_GET['action'];
            $proid = $_GET['proid'];
            if ($action == 'addcart') {
                $product = Pro::getOneByID($proid);
                if ($product) {
                    $proidCol = Cart::getOneCartByID($pdo, $username, $product->id);
                    if ($proidCol) {
                        $sql = "UPDATE `cart` SET Quantity= :quantity WHERE UserName = :username AND ProductsId = :productsid";
                        $stmt = $pdo->prepare($sql);
                        $Quantity = $proidCol->Quantity + 1;
                        $stmt->bindParam(':quantity', $Quantity, PDO::PARAM_INT);
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':productsid', $product->id, PDO::PARAM_INT);
                        if ($stmt->execute()) {
                            header("location: index.php");
                        } else {
                            $error = $stmt->errorInfo();
                            var_dump($error);
                        }
                    } else {   
                        $sql = "INSERT INTO `cart`(`ProductsId`, `UserName`, `Quantity`, `Price`) VALUES (:productsid, :username, :quantity, :price)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':productsid', $product->id, PDO::PARAM_INT);
                        $stmt->bindValue(':quantity', 1, PDO::PARAM_INT);
                        $stmt->bindValue(':price', $product->price, PDO::PARAM_INT);

                        if ($stmt->execute()) {
                            header("location: index.php");
                        } else {
                            $error = $stmt->errorInfo();
                            var_dump($error);
                        }
                    }
                }
            }
        }
    }
    public static function DeleteCart($username, $productsid)
    {
        $db = new Data();
        $pdo = $db->getConn();
        $sql = "DELETE FROM `cart` WHERE UserName = :username AND ProductsId = :productsid";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':productsid', $productsid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('location:cart.php');
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }

}
