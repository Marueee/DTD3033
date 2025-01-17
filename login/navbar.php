<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="../index.php">La<span>Passion</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="../index.php" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="../rooms/rooms.php" class="nav-link">Our Rooms</a></li>
				<li class="nav-item"><a href="../restaurant.php" class="nav-link">Restaurant</a></li>
				<li class="nav-item"><a href="../about.php" class="nav-link">About Us</a></li>
				<li class="nav-item"><a href="../contact.php" class="nav-link">Contact</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i> Profile
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
						<?php if (isset($_SESSION['username'])): ?>
							<a class="dropdown-item" href="../profile.php">My Profile</a>
							<a class="dropdown-item" href="logout.php">Logout</a>
						<?php else: ?>
							<a class="dropdown-item" href="logins.php">Login</a>
							<a class="dropdown-item" href="../register/registers.php">Register</a>
						<?php endif; ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>