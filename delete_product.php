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
$title = 'Delete product page';
require 'class/Pro.php';
session_start();


$id = $_GET["id"];

$product = Pro::getOneByID($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Data();

    $check = $db->delete($id);

    if ($check) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('location: index.php');
    }
}

?>

<?php require 'inc/header.php'?>

<?php if(!isset($_SESSION['log_detail'])): ?>
    <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn cần đăng nhập</h1>
<?php else:?>
    <?php if($_SESSION['log_detail'] == "0"): ?>
        <h1 style="text-align: center; color: red; padding-top: 170px;">Bạn không có quyền xóa sản phẩm</h1>
    <?php else:?>
        <h2 style="padding-top: 170px;">Xác nhận xóa sản phẩm này</h2>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <td><?= $product->id ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= $product->name ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= $product->fullDesc ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?= $product->price ?></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" style="margin-top: 30px; background-color:red">Delete</button>
            <a href="single.php?id=<?= $product->id ?>" class="btn btn-danger" style="margin-top: 30px; background-color:black">Cancel</a>
        </form>
    <?php endif; ?>
<?php endif;?>

<?php require 'inc/footer.php'?>