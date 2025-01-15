<!DOCTYPE html>
<html lang="en">


<head>
	<?php include 'head.php'; ?>
</head>

<body>

	<?php
		if (session_status() == PHP_SESSION_NONE) {
   		session_start();
		}
	?>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.php">La<span>Passion</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="rooms/rooms.php" class="nav-link">Our Rooms</a></li>
				<li class="nav-item active"><a href="restaurant.php" class="nav-link">Restaurant</a></li>
				<li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
				<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i> Profile
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
						<?php if (isset($_SESSION['username'])): ?>
							<a class="dropdown-item" href="profile.php">My Profile</a>
							<a class="dropdown-item" href="reservation.php">My Reservations</a>
							<a class="dropdown-item" href="login/logout.php">Logout</a>
						<?php else: ?>
							<a class="dropdown-item" href="login/logins.php">Login</a>
							<a class="dropdown-item" href="register/registers.php">Register</a>
						<?php endif; ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
	</nav>

	<div class="hero-wrap" style="background-image: url('images/bg_3.jpg');">
	<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
					<div class="text">
						<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>Restaurant</span></p>
						<h1 class="mb-4 bread">Restaurant</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="single-slider-resto mb-4 mb-md-0 owl-carousel">
						<div class="item">
							<div class="resto-img rounded" style="background-image: url(images/menu-1.jpg);"></div>
						</div>
						<div class="item">
							<div class="resto-img rounded" style="background-image: url(images/menu-6.jpg);"></div>
						</div>
						<div class="item">
							<div class="resto-img rounded" style="background-image: url(images/menu-5.jpg);"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6 pl-md-5">
					<div class="heading-section mb-4 my-5 my-md-0">
						<span class="subheading">About La Passion Hotel</span>
						<h2 class="mb-4">La Passion Hotel Restaurants</h2>
					</div>
					<p>Our hotel restaurant serves a variety of local and international cuisines, prepared with fresh, high-quality ingredients to delight every palate. </p>
					<p>The elegant ambiance and attentive service create a perfect dining experience for casual meals, celebrations, or business gatherings.</p>
					<p><a href="#" class="btn btn-secondary rounded">More info</a></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-menu bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">LaPassion Resto Menu</span>
					<h2>Our Specialties</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/nasiKerabu.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Nasi Kerabu</span></h3>
								<span class="price">RM20.00</span>
							</div>
							<div class="d-block">
								<p>Fragrant blue rice with fresh herbs, grilled meats, and a spicy coconut-based sauce.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/NasiLemak.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Nasi Lemak</span></h3>
								<span class="price">RM13.00</span>
							</div>
							<div class="d-block">
								<p>Coconut-infused rice served with sambal, crispy anchovies, boiled egg, peanuts, and cucumber.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/menu-3.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Pancake</span></h3>
								<span class="price">RM9.00</span>
							</div>
							<div class="d-block">
								<p>Fluffy, golden pancakes served with maple syrup, fresh berries, and a dollop of whipped cream.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/menu-4.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Beef Steak</span></h3>
								<span class="price">RM80.00</span>
							</div>
							<div class="d-block">
								<p>Juicy, tender grilled beefsteak served with creamy sauce, garlic mashed potatoes, and buttered vegetables.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/Pizza.jpeg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Pizza</span></h3>
								<span class="price">RM79.00</span>
							</div>
							<div class="d-block">
								<p>Hand-tossed pizza with a crispy crust, rich tomato sauce, melted cheese, and your choice of toppings.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/Lobster.jpeg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Grilled Tail Lobster</span></h3>
								<span class="price">RM45.00</span>
							</div>
							<div class="d-block">
								<p>Succulent lobster tail grilled to perfection, served with garlic butter and lemon wedges</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/Oyster.jpeg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Fresh Oyster</span></h3>
								<span class="price">RM80.00</span>
							</div>
							<div class="d-block">
								<p>Delicate and briny, served on ice with lemon and a tangy vinaigrette.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/WagyuA5.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Wagyu A5</span></h3>
								<span class="price">RM230.00</span>
							</div>
							<div class="d-block">
								<p>Exquisite marbled Wagyu beef, grilled to perfection for a melt-in-your-mouth experience.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 d-flex">
					<div class="pricing-entry rounded d-flex ftco-animate">
						<div class="img" style="background-image: url(images/SetTalam.jpg);"></div>
						<div class="desc p-4">
							<div class="d-md-flex text align-items-start">
								<h3><span>Talam Set</span></h3>
								<span class="price">RM129.00</span>
							</div>
							<div class="d-block">
								<p>A generous platter of rice, curries, grilled meats, and assorted sides, perfect for 3-4 people to share.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include 'footer.php'; ?>

	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

</body>

</html>