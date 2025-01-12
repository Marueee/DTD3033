<?php
session_start();

include '../auth/db_config.php';

$response = array('status' => '', 'message' => '', 'role' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT user_id, username, password, role FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $response['status'] = 'success';
            $response['message'] = 'Login successful! Redirecting...';
            $response['role'] = $user['role'];
            echo json_encode($response);
            exit();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid password. Please try again.';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Username not found. Please try again.';
        echo json_encode($response);
        exit();
    }
}
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

    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <p class="footer-text">Don't have an account? <a href="../register/register.php">Register here</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'loginpab.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function() {
                                if (response.role === 'admin') {
                                    window.location.href = '../admin-index.php';
                                } else {
                                    window.location.href = '../index.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    }
                });
            });
        });
    </script>

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
