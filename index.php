<!DOCTYPE html>
<html lang="en">

<head>
	<title>Colo Shop</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="css/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles/responsive.css">
</head>

<?php
require 'class/Pro.php';
require 'class/Cart.php';
session_start();

$db = new Data();
$pdo = $db->getConn();

$nike = Pro::getNike();
$adidas = Pro::getAdidas();
$home = Pro::getHome();
if (isset($_GET['action']) && isset($_GET['proid']))
    {
        if (!isset($_SESSION['log_detail']))
        {
            header('location:login.php');
        }
        else
        {
            Cart::AddtoCart();
        }
    }
require 'inc/header.php';
?>

<!-- Slider -->

<div class="main_slider" style="background-image:url(images/banner.png)">
	<div class="container fill_height">
		<div class="row align-items-center fill_height">
			<div class="col">
				<div class="main_slider_content">
					<h6 style="color: white;">Spring / Summer Collection 2023</h6>
					<h1 style="color: white;">Get up to 30% Off New Arrivals</h1>
					<div class="red_button shop_now_button"><a href="#">shop now</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Banner -->

<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="banner_item align-items-center" style="background-image:url(images/banner_2.jpg)">
					<div class="banner_category">
						<a href="women.php">women's</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="banner_item align-items-center" style="background-image:url(images/banner_1.jpg)">
					<div class="banner_category">
						<a href="men.php">men's</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Nike -->

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Nike</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

					<?php foreach ($nike as $pro) : ?>
						<div class="product-item men">
							<div class="product discount product_filter">
								<?php foreach ($pro as $key => $value) : ?>
									<?php if ($key == 'avatar') : ?>
										<div class="product_image">
											<img src="images/<?= $value ?>" alt="">
										</div>
									<?php endif; ?>
									<div class="product_info">
										<?php if ($key == 'name') : ?>
											<h6 class="product_name"><a href="single.php?id=<?= $pro->id ?>"><?= $value ?></a></h6>
										<?php elseif ($key == 'priceDiscount') : 
											$priceDiscount = $value;?>
										<?php elseif ($key == 'price') : ?>
											<?php if($value > $priceDiscount):?>
												<div class="product_price"><?= $priceDiscount ?>đ<span><?= $value ?>đ</span></div>
											<?php else:?>
												<div class="product_price"><?= $value ?></div>
												<?php endif; ?>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="red_button add_to_cart_button"><a href="index.php?action=addcart&proid=<?= $pro->id ?>">add to cart</a></div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</div>
</div>



<!-- Adidas -->

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Adidas</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<?php foreach ($adidas as $pro) : ?>
						<div class="product-item men">
							<div class="product discount product_filter">
								<?php foreach ($pro as $key => $value) : ?>
									<?php if ($key == 'avatar') : ?>
										<div class="product_image">
											<img src="images/<?= $value ?>" alt="">
										</div>
									<?php endif; ?>
									<div class="product_info">
										<?php if ($key == 'name') : ?>
											<h6 class="product_name"><a href="single.php?id=<?= $pro->id ?>"><?= $value ?></a></h6>
										<?php elseif ($key == 'priceDiscount') : ?>
											<div class="product_price"><span><?= $value ?>đ</span></div>
										<?php elseif ($key == 'price') : ?>
											<div class="product_price"><?= $value ?>đ</div>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="red_button add_to_cart_button"><a href="index.php?action=addcart&proid=<?= $pro->id ?>">add to cart</a></div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Deal of the week -->

<div class="deal_ofthe_week">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="deal_ofthe_week_img">
					<img src="images/deal_ofthe_week.png" alt="">
				</div>
			</div>
			<div class="col-lg-6 text-right deal_ofthe_week_col">
				<div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
					<div class="section_title">
						<h2>Deal Of The Week</h2>
					</div>
					<ul class="timer">
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="day" class="timer_num">03</div>
							<div class="timer_unit">Day</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="hour" class="timer_num">15</div>
							<div class="timer_unit">Hours</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="minute" class="timer_num">45</div>
							<div class="timer_unit">Mins</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="second" class="timer_num">23</div>
							<div class="timer_unit">Sec</div>
						</li>
					</ul>
					<div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Best Sellers -->

<div class="best_sellers">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>Best Sellers</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product_slider_container">
					<div class="owl-carousel owl-theme product_slider">

						<!-- Slide 1 -->

						<?php foreach ($home as $pro) : ?>
							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<?php foreach ($pro as $key => $value) : ?>
											<?php if ($key == 'avatar') : ?>
												<div class="product_image">
													<img src="images/<?= $value ?>" alt="">
												</div>
											<?php endif; ?>
											<div class="product_info">
												<?php if ($key == 'name') : ?>
													<h6 class="product_name"><a href="single.php?id=<?= $pro->id ?>"><?= $value ?></a></h6>
												<?php elseif ($key == 'priceDiscount') : ?>
													<div class="product_price"><span><?= $value ?>đ</span></div>
												<?php elseif ($key == 'price') : ?>
													<div class="product_price"><?= $value ?>đ</div>
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>

					<!-- Slider Navigation -->

					<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
					</div>
					<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require 'inc/footer.php'; ?>