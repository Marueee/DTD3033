<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
    exit;
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "haikal";
$password = "haikal03";
$database = "hotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch room types and availability
$rooms = [];
$result = $conn->query("SELECT room_id, room_type, price, (SELECT COUNT(*) FROM reservations WHERE rooms.room_id = reservations.room_id AND checkin_date <= CURDATE() AND checkout_date >= CURDATE()) AS occupied FROM rooms");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!isset($rooms[$row['room_type']])) {
            $rooms[$row['room_type']] = [
                'room_id' => $row['room_id'],
                'price' => $row['price'],
                'occupied' => $row['occupied'],
                'total' => 1
            ];
        } else {
            $rooms[$row['room_type']]['total']++;
            $rooms[$row['room_type']]['occupied'] += $row['occupied'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    $room_id = $_POST['room']; // Assuming room_id is selected from a dropdown
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $no_of_guest = $_POST['no_of_guest'];

    // Fetch the price for the selected room
    $result = $conn->query("SELECT price FROM rooms WHERE room_id = '$room_id'");
    $room = $result->fetch_assoc();
    $price_per_night = $room['price'];

    // Calculate total price (assuming price is per night)
    $checkin_date = new DateTime($checkin);
    $checkout_date = new DateTime($checkout);
    $interval = $checkin_date->diff($checkout_date);
    $nights = $interval->days;
    $total_price = $nights * $price_per_night * $no_of_guest;

    $sql = "INSERT INTO reservations (user_id, room_id, checkin_date, checkout_date, no_of_guest, total_price) 
            VALUES ('$user_id', '$room_id', '$checkin', '$checkout', '$no_of_guest', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../head.php'; ?>
    <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include '../navbar.php'; ?>
    
    <div class="hero-wrap hero-bread" style="background-image: url('../images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Booking</span></p>
                    <h1 class="mb-0 bread">Hotel Booking</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form id="registrationForm" method="post" action="" class="billing-form">
                        <h3 class="mb-4 billing-heading">Booking Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="room">Room Type</label>
                                    <select id="room" name="room" class="form-control">
                                        <?php foreach ($rooms as $room_type => $room): ?>
                                            <?php if ($room['occupied'] < $room['total']): ?>
                                                <option value="<?php echo $room['room_id']; ?>"><?php echo $room_type; ?> - $<?php echo $room['price']; ?>/night</option>
                                            <?php else: ?>
                                                <option value="" disabled><?php echo $room_type; ?> - Out of room</option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkin">Check-In Date</label>
                                    <input type="date" id="checkin" name="checkin" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkout">Check-Out Date</label>
                                    <input type="date" id="checkout" name="checkout" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_of_guest">Number of Guests</label>
                                    <input type="number" id="no_of_guest" name="no_of_guest" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_price">Total Price</label>
                                    <input type="number" step="0.01" id="total_price" name="total_price" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include '../footer.php'; ?>
    
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/jquery.animateNumber.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="../js/google-map.js"></script>
    <script src="../js/main.js"></script>
    <script>
        document.getElementById('room').addEventListener('change', calculateTotalPrice);
        document.getElementById('checkin').addEventListener('change', calculateTotalPrice);
        document.getElementById('checkout').addEventListener('change', calculateTotalPrice);
        document.getElementById('no_of_guest').addEventListener('change', calculateTotalPrice);

        function calculateTotalPrice() {
            const roomSelect = document.getElementById('room');
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const noOfGuest = document.getElementById('no_of_guest').value;

            if (roomSelect.value && checkin && checkout && noOfGuest) {
                const roomPrice = parseFloat(roomSelect.options[roomSelect.selectedIndex].text.split('- $')[1].split('/night')[0]);
                const checkinDate = new Date(checkin);
                const checkoutDate = new Date(checkout);
                const nights = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
                const totalPrice = nights * roomPrice * noOfGuest;
                document.getElementById('total_price').value = totalPrice.toFixed(2);
            }
        }
    </script>
</body>
</html>
