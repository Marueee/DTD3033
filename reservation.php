<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login/logins.php');
    exit;
}

include 'auth/db_config.php';

// Fetch user bookings
$user_id = $_SESSION['user_id'];
$booking_query = "SELECT rooms.room_number, reservations.checkin_date, reservations.checkout_date, reservations.total_price, reservations.reservation_status 
                  FROM reservations 
                  JOIN rooms ON reservations.room_id = rooms.room_id 
                  WHERE reservations.user_id = ? 
                  ORDER BY reservations.checkin_date DESC";
$stmt = $conn->prepare($booking_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$bookings_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Reservations</span></p>
                    <h1 class="mb-0 bread">My Reservations</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <h3 class="mb-4">My Bookings</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($bookings_result->num_rows > 0) {
                                while ($booking = $bookings_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $booking['room_number'] . "</td>";
                                    echo "<td>" . date('d M Y', strtotime($booking['checkin_date'])) . "</td>";
                                    echo "<td>" . date('d M Y', strtotime($booking['checkout_date'])) . "</td>";
                                    echo "<td>RM" . $booking['total_price'] . "</td>";
                                    echo "<td>" . ucfirst($booking['reservation_status']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    
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
