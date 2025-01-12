<!DOCTYPE html>
<html lang="en">

<?php
  session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login/loginpab.php');
    exit;
}?>

<head>
    <?php include '../head.php';?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="../index.php">La<span>Passion</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="../rooms.php" class="nav-link">Our Rooms</a></li>
            <li class="nav-item"><a href="../restaurant.html" class="nav-link">Restaurant</a></li>
            <li class="nav-item"><a href="../about.html" class="nav-link">About Us</a></li>
            <li class="nav-item"><a href="../blog.html" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="../contact.html" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap" style="background-image: url('../images/bg_3.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
            <div class="text">
              <p class="breadcrumbs mb-2"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Booking</span></p>
              <h1 class="mb-4 bread">Hotel Registration</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Booking</span>
            <h2 class="mb-4">Register Your Stay</h2>
          </div>
        </div>
        <div class="container">
          <form id="registrationForm" method="post" action="process_registration.php">
            <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
              <label for="room">Room Type:</label>
              <select id="room" name="room">
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
              </select>
            </div>
            <div class="form-group">
              <label for="checkin">Check-In Date:</label>
              <input type="date" id="checkin" name="checkin" required>
            </div>
            <div class="form-group">
              <label for="checkout">Check-Out Date:</label>
              <input type="date" id="checkout" name="checkout" required>
            </div>
            <button type="submit">Register</button>
          </form>
        </div>
      </div>
    </section>

    <?php include '../footer.php';?>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const checkin = new Date(document.getElementById('checkin').value);
            const checkout = new Date(document.getElementById('checkout').value);

            if (checkin >= checkout) {
                e.preventDefault();
                alert('Check-Out Date must be after Check-In Date.');
            }
        });
    </script>
</body>

</html>

<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room = $_POST['room'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $sql = "INSERT INTO registrations (name, email, phone, room_type, checkin_date, checkout_date) 
            VALUES ('$name', '$email', '$phone', '$room', '$checkin', '$checkout')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>