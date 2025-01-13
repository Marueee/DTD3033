<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="../admin-index.php">Admin Panel</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item <?php echo ($current_page == 'admin-index.php') ? 'active' : ''; ?>">
				<a class="nav-link" href="../admin-index.php">Dashboard</a>
			</li>
			<li class="nav-item <?php echo ($current_page == 'rooms-admin.php' || $current_page == 'add-rooms.php' || $current_page == 'edit-room.php' || $current_page == 'show-rooms-admin.php') ? 'active' : ''; ?>">
				<a class="nav-link" href="rooms-admin.php">Manage Rooms</a>
			</li>
			<li class="nav-item <?php echo ($current_page == 'booking-admin.php' || $current_page == 'view-booking.php' || $current_page == 'edit-booking.php') ? 'active' : ''; ?>">
				<a class="nav-link" href="../booking/booking-admin.php">Manage Bookings</a>
			</li>
			<li class="nav-item <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
				<a class="nav-link" href="settings.php">Settings</a>
			</li>
		</ul>
	</div>
</nav>
