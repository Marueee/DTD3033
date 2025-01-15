<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'head.php'; 
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }?>

<body>

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
				<li class="nav-item"><a href="restaurant.php" class="nav-link">Restaurant</a></li>
				<li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
				<li class="nav-item active"><a href="contact.php" class="nav-link">Contact</a></li>
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
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact Us</span></p>
            <h1 class="mb-4 bread">Contact Us</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-12 mb-4">
          <h2 class="h3">Contact Information</h2>
        </div>
        <div class="w-100"></div>
        <div class="col-md-3 d-flex">
          <div class="info rounded bg-white p-4">
            <p><span><i class="icon-map-marker"></i> Address:</span> Kolej Harun Aminurrashid, Universiti Pendidikan Sultan Idris, Kampus Sultan Azlan Shah, 35900 Tanjong Malim, Perak </p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info rounded bg-white p-4">
            <p><span><i class="icon-phone"></i> Phone:</span> <a href="tel://1234567920">+605-450 6627</a></p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info rounded bg-white p-4">
            <p><span><i class="icon-envelope"></i> Email:</span> <a href="mailto:info@yoursite.com">admin@meta.upsi.edu.my</a></p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info rounded bg-white p-4">
            <p><span><i class="icon-globe"></i> Website:</span> <a href="https://d20221101806-dtd3033.a241.meta-upsi.com/Group-Project/DTD3033/">https://d20221101806-dtd3033.a241.meta-upsi.com/Group-Project/DTD3033/</a></p>
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