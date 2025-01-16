<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="admin-index.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo ($current_page == 'admin-index.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="admin-index.php">Dashboard</a>
            </li>
            <li class="nav-item <?php echo ($current_dir == 'rooms') ? 'active' : ''; ?>">
                <a class="nav-link" href="rooms/rooms-admin.php">Manage Rooms</a>
            </li>
            <li class="nav-item <?php echo ($current_dir == 'booking') ? 'active' : ''; ?>">
                <a class="nav-link" href="booking/booking-admin.php">Manage Bookings</a>
            </li>
            <li class="nav-item <?php echo ($current_page == 'manage-users.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="manage-users.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
