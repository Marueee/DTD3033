<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php'; 
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }?>
    
  </head>
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
				<li class="nav-item active"><a href="about.php" class="nav-link">About Us</a></li>
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
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home</a></span> <span>About Us</span></p>
	            <h1 class="mb-4 bread">About La Passion Hotel</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Welcome to La Passion Hotel</span>
            <h2 class="mb-4">You'll Never Want To Leave</h2>
          </div>
        </div>  
        <div class="row d-flex">
          <div class="col-md pr-md-1 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="flaticon-reception-bell"></span>
              	</div>
              </div>
              <div class="media-body">
                <h3 class="heading mb-3">Friendly Service</h3>
              </div>
            </div>      
          </div>
          <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services active py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="flaticon-serving-dish"></span>
              	</div>
              </div>
              <div class="media-body">
                <h3 class="heading mb-3">Get Breakfast</h3>
              </div>
            </div>    
          </div>
          
          <div class="col-md px-md-1 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="flaticon-spa"></span>
              	</div>
              </div>
              <div class="media-body">
                <h3 class="heading mb-3">Suits &amp; SPA</h3>
              </div>
            </div>      
          </div>
          <div class="col-md pl-md-1 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services py-4 d-block text-center">
              <div class="d-flex justify-content-center">
              	<div class="icon d-flex align-items-center justify-content-center">
              		<span class="ion-ios-bed"></span>
              	</div>
              </div>
              <div class="media-body">
                <h3 class="heading mb-3">Cozy Rooms</h3>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-wrap-about ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-7 order-md-last d-flex">
						<div class="img img-1 mr-md-2 ftco-animate" style="background-image: url(images/about-1.jpg);"></div>
						<div class="img img-2 ml-md-2 ftco-animate" style="background-image: url(images/about-2.jpg);"></div>
					</div>
					<div class="col-md-5 wrap-about pb-md-3 ftco-animate pr-md-5 pb-md-5 pt-md-4">
	          <div class="heading-section mb-4 my-5 my-md-0">
	          	<span class="subheading">About La Passion Hotel</span>
	            <h2 class="mb-4">La Passion Hotel the Most Recommended Hotel All Over the World</h2>
	          </div>
	          <p>La Passion Hotel combines elegance, comfort, and exceptional service to create an unforgettable stay for every guest. Nestled in a prime location, our hotel offers the perfect balance of tranquility and accessibility, making it an ideal destination for both leisure and business travelers.</p>
	          <p><a href="rooms/rooms.php" class="btn btn-secondary rounded">Reserve Your Room Now</a></p>
					</div>
				</div>
			</div>
		</section>

    <!-- <section class="testimony-section">
		<div class="container">
			<div class="row no-gutters ftco-animate justify-content-center">
				<div class="col-md-5 d-flex">
					<div class="testimony-img aside-stretch-2" style="background-image: url(images/testimony-img.jpg);"></div>
				</div>
				<div class="col-md-7 py-5 pl-md-5">
					<div class="py-md-5">
						<div class="heading-section ftco-animate mb-4">
							<span class="subheading">Testimony</span>
							<h2 class="mb-0">Happy Customer</h2>
						</div>
						<div class="carousel-testimony owl-carousel ftco-animate">
							<div class="item">
								<div class="testimony-wrap pb-4">
									<div class="text">
										<p class="mb-4">The family room was spacious and comfortable, and the kids loved the pool! The hotel staff made us feel so welcome, and the location was ideal for exploring the city.</p>
									</div>
									<div class="d-flex">
										<div class="user-img" style="background-image: url(images/person_1.jpg)">
										</div>
										<div class="pos ml-3">
											<p class="name">Meowmad Ali</p>
											<span class="position">Businessman</span>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap pb-4">
									<div class="text">
										<p class="mb-4">As a frequent traveler, I was impressed by how seamless everything was—great Wi-Fi, comfortable workspaces, and a peaceful environment. Highly recommended for business trips!</p>
									</div>
									<div class="d-flex">
										<div class="user-img" style="background-image: url(images/person_5.jpg)">
										</div>
										<div class="pos ml-3">
											<p class="name">Ahmad Karim</p>
											<span class="position">CEO</span>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap pb-4">
									<div class="text">
										<p class="mb-4">While the staff was polite and helpful, the room service took longer than expected, and the Wi-Fi connection was inconsistent. Fixing these issues would make this hotel perfect!</p>
									</div>
									<div class="d-flex">
										<div class="user-img" style="background-image: url(images/Person_3.jpeg)">
										</div>
										<div class="pos ml-3">
											<p class="name">Zarif</p>
											<span class="position">Athlete</span>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap pb-4">
									<div class="text">
										<p class="mb-4">The hotel exceeded my expectations in every way. The rooms were spotless, the staff was incredibly friendly, and the amenities were top-notch. I’ll definitely be coming back!</p>
									</div>
									<div class="d-flex">
										<div class="user-img" style="background-image: url(images/person_4.jpg)">
										</div>
										<div class="pos ml-3">
											<p class="name">Asfar</p>
											<span class="position">Businessman</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
		
		<section class="instagram ftco-section ftco-no-pb">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Photos</span>
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    
  <?php include 'footer.php'; ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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