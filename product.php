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
require 'class/Pro.php';
session_start();

$db = new Data();
$pdo = $db->getConn();

$product_per_page = 10;
$page = $_GET['page'] ?? 1;
$limit = $product_per_page;
$offset = ($page - 1) * $product_per_page;

$data = Pro::getPage($pdo, $limit, $offset);

$countpage = ceil(count(Pro::getAll()) / $product_per_page);

$prevpage = $page - 1;
if ($prevpage <= 0) :
	$prevpage = 1;
endif;

$nextpage = $page + 1;
if ($nextpage > $countpage) :
	$nextpage = $countpage;
endif;
	require 'inc/header.php';
?>


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
							<?php foreach ($data as $pro) : ?>
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


		<ul class="pagination justify-content-center">
			<li class="page-item">
				<a class="page-link" href="product.php?page=<?= $prevpage ?>">
					Previous
				</a>
			</li>
			<?php for ($i = 1; $i <= $countpage; $i++) : ?>
				<?php if ($i == $page) : ?>
					<li class="page-item active">
						<a class="page-link" href="product.php?page=<?= $i ?>">
							<?= $i ?>
						</a>
					</li>
				<?php else : ?>
					<li class="page-item">
						<a class="page-link" href="product.php?page=<?= $i ?>">
							<?= $i ?>
						</a>
					</li>
				<?php endif ?>
			<?php endfor ?>
			<li class="page-item">
				<a class="page-link" href="product.php?page=<?= $nextpage ?>">
					Next
				</a>
			</li>
		</ul>
<?php require 'inc/footer.php';?>