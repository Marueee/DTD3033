<?php
session_start();

include '../auth/db_config.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user'; // Default role

    // Check if username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Username already exists. Please choose another one.';
        echo json_encode($response);
        exit();
    } else {
        // Insert new user
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($conn->query($query) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Registration successful! Redirecting to login...';
            echo json_encode($response);
            exit();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $conn->error;
            echo json_encode($response);
            exit();
        }
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
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Register</span></p>
                    <h1 class="mb-0 bread">Register</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form method="POST" class="billing-form">
                        <h3 class="mb-4 billing-heading">Registration Details</h3>
                        <div class="row align-items-end">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" id="name" name="name" placeholder="Enter your full name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="phone" id="phone" name="phone" placeholder="Enter your phone number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Enter your username" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirm_password">Password</label>
                                    <input type="confirm_password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="footer-text">Already have an account? <a href="../login/login.php">Login here</a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</body>
</html>
