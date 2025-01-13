<?php
include 'head.php';
include '../auth/db_config.php';

// Check if user is logged in and has admin role
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'head.php'; ?>
	<style>
		/* Improve visibility */
		.admin-hero .text h1, .admin-hero .text h2 {
			color: #fff !important;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5) !important;
		}
		/* Add icons without circles */
		.media .icon {
			position: relative !important;
			width: 60px !important;
			height: 60px !important;
			background: transparent !important;
			color: #000 !important;
			font-size: 24px !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			border-radius: 0 !important;
		}
		.media .icon span {
			position: absolute !important;
		}
		/* Change text color on hover */
		.media .icon:hover {
			color: #fff !important;
		}
		/* Ensure link text color changes on hover */
		.media .heading a:hover {
			color: #fff !important;
		}
		/* Ensure link text color changes on hover for specific links */
		.media .heading a:hover span {
			color: #fff !important;
		}
		/* Ensure the text color changes to white when hovering over the square */
		.media:hover .heading a {
			color: #fff !important;
		}
		/* Ensure the text color changes to white when hovering over the square */
		.media:hover .icon {
			color: #fff !important;
		}
	</style>
</head>

<body>

	<?php include 'admin-navbar.php'; ?>

	<div class="admin-hero">
		<section class="admin-home-slider owl-carousel">
			<div class="slider-item" style="background-image:url(images/admin_bg_1.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-center justify-content-end">
						<div class="col-md-6 ftco-animate">
							<div class="text">
								<h2>Welcome Admin</h2>
								<h1 class="mb-3">Manage Your Hotel Efficiently</h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item" style="background-image:url(images/admin_bg_2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-center justify-content-end">
						<div class="col-md-6 ftco-animate">
							<div class="text">
								<h2>Admin Dashboard</h2>
								<h1 class="mb-3">All the Tools You Need</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Admin Panel</span>
					<h2 class="mb-4">Manage Your Hotel</h2>
				</div>
			</div>
			<div class="row d-flex">
				<div class="col-md pr-md-1 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services py-4 d-block text-center">
						<div class="d-flex justify-content-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-dashboard"></span>
							</div>
						</div>
						<div class="media-body">
							<h3 class="heading mb-3"><a href="admin-dashboard.php"><span class="flaticon-dashboard"></span> Dashboard</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services active py-4 d-block text-center">
						<div class="d-flex justify-content-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-room-service"></span>
							</div>
						</div>
						<div class="media-body">
							<h3 class="heading mb-3"><a href="rooms/rooms-admin.php"><span class="flaticon-room-service"></span> Manage Rooms</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services py-4 d-block text-center">
						<div class="d-flex justify-content-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-booking"></span>
							</div>
						</div>
						<div class="media-body">
							<h3 class="heading mb-3"><a href="manage-bookings.php"><span class="flaticon-booking"></span> Manage Bookings</a></h3>
						</div>
					</div>
				</div>
				<div class="col-md pl-md-1 d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services py-4 d-block text-center">
						<div class="d-flex justify-content-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-settings"></span>
							</div>
						</div>
						<div class="media-body">
							<h3 class="heading mb-3"><a href="settings.php"><span class="flaticon-settings"></span> Settings</a></h3>
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