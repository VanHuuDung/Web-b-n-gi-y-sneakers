<body>

	<div class="super_container">

		<!-- Header -->

		<header class="header trans_300">

			<!-- Top Navigation -->

			<div class="top_nav">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="top_nav_left">free shipping on all u.s orders over $50</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<div class="main_nav_container">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-right">
							<div class="logo_container">
								<a href="#">colo<span>shop</span></a>
							</div>
							<nav class="navbar">
								<ul class="navbar_menu">
									<li><a href="index.php">home</a></li>
									<li><a href="product.php">shop</a></li>
									<?php if (!isset($_SESSION['log_detail'])) : ?>
										<li><a href="login.php">login</a></li>
										<li><a href="register.php">register</a></li>
									<?php else : ?>
										<?php if ($_SESSION['log_detail'] == "1") : ?>
											<li><a href="new-product.php">Add New</a></li>
											<li><a href="quantriuser.php">User</a></li>
										<?php endif; ?>
										<li><a href="logout.php">logout</a></li>
									<?php endif; ?>
								</ul>
								<ul class="navbar_user">
									<li class="checkout">
										<a href="cart.php">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										</a>
									</li>
								</ul>
								<div class="hamburger_container">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>

		</header>