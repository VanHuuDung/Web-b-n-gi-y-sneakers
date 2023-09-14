<!DOCTYPE html>
<html lang="en">

<head>
	<title>Colo Shop</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/responsive.css">
</head>

<?php 
    session_start();
    if( !isset($_SESSION['log_detail']))
    {
        header('location: login.php');
        exit;
    }
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $title = 'Cart';
    require 'class/Pro.php';
    require 'class/Cart.php';
    
    $username = $_SESSION['user'];

    $db = new Data();
    $pdo = $db->getConn();
    $data=Cart::getAll($pdo, $username);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "UPDATE cart SET Quantity=:quantity WHERE UserName=:username AND ProductsId=:productsid";
        $stmt = $pdo->prepare($sql);
                    
        $stmt->bindParam(':quantity',$_POST['qty'], PDO::PARAM_INT);
        $stmt->bindParam(':username',  $username, PDO::PARAM_STR);
        $stmt->bindParam(':productsid',$_POST['productsid'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $data=Cart::getAll($pdo,$username);
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
        }
    }
    if(isset($_GET["action"])&&isset($_GET["username"])&&isset($_GET["productsid"])){
        $user = $_GET["username"];
        $productsid = $_GET["productsid"];
        Cart::DeleteCart($user, $productsid);
    }
    
    require 'inc/header.php';
?>

<div style="padding-top: 170px;" class="container"> 
    <table class="table my-3">
        <thead> 
            <tr class="text-center">
                    <th>No</th>
                    <th>Pro name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php  $i = 1; $total = 0; $price = 0; $quan = 0; $proid = 0?>
                <?php foreach ($data as $product):?>
                    <form method="post"> 
                        <tr>
                            <td><?= $i ?></td>  
                            <?php foreach (get_object_vars($product) as $key => $value): ?>           
                                <?php if ($key == 'ProductsName'): ?>
                                <input type="hidden" name="productsname" value="<?= $value?>  " />
                                    <td><a><?= $value ?></a></td>
                                <?php elseif ($key == 'ProductsId'): 
                                    $proid = $value?>
                                    <input type="hidden" name="productsid" value="<?= $value?>  " />
                                <?php elseif ($key == 'Price'): 
                                    $price = $value;?>
                                    <td><?= number_format($value, 0, ',', '.') ?> VNĐ</td>
                                <?php elseif ($key == 'Quantity'):
                                    $quan = $value; ?>
                                    <td>
                                        <input type="number" value="<?= $value ?>" name="qty" min="1" style="width: 50px;" />
                                        
                                    </td>
                                    <td>
                                        <input type="submit" name="update" value="Update" class="btn btn-warning" /> 
                                        <a href="cart.php?action=detele&username=<?= $username ?>&productsid=<?= $proid ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>     
                    </form> 
                    <?php  $i++; $total += $price * $quan;?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="text-center">
                        <h4>Total: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
<?php
    include 'inc/footer.php';
 ?>