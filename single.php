<!DOCTYPE html>
<html lang="en">

<head>
	<title>Single Product</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/themify-icons/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/styles/single_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/single_responsive.css">
</head>

<?php
session_start();
if (!isset($_GET["id"])) {
	die("bạn cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

require 'class/Pro.php';
require 'inc/header.php';

$pro = Pro::getOneByID($id);

if (!$pro) {
	die("ID không hợp lệ");
}
?>

<div class="fs_menu_overlay"></div>
<div class="container single_product_container">
	<div class="row">
		<div class="col">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product</a></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-lg-7">
			<div class="single_product_pics">
				<div class="row">
					<div class="col-lg-9 image_col order-lg-2 order-6">
						<div class="single_product_image">
							<img width="500px;" src="images/<?= $pro->avatar ?>" alt="" data-image="images/<?= $pro->avatar ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="product_details">
				<div class="product_details_title">
					<h2><?= $pro->name ?></h2>
					<p><?= $pro->fullDesc ?></p>
				</div>
				<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
					<span class="ti-truck"></span><span>free delivery</span>
				</div>
				<div class="original_price"><?= $pro->priceDiscount ?></div>
				<div class="product_price"><?= $pro->price ?></div>
				<ul class="star_rating">
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
				</ul>
				<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
					<div class="red_button add_to_cart_button"><a href="index.php?action=addcart&proid=<?= $pro->id ?>">add to cart</a></div>
					<div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
				</div>	

				<?php if (isset($_SESSION['log_detail'])) : ?>
					<?php if ($_SESSION['log_detail'] == "1") : ?>
						<div style="margin-top: 50px;" class="red_button add_to_cart_button"><a href="edit_product.php?id=<?= $pro->id ?>">Edit</a></div>
						<div class="red_button add_to_cart_button"><a href="delete_product.php?id=<?= $pro->id ?>">Delete</a></div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>

</div>

<?php require 'inc/footer.php'; ?>