<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Registration</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
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
    <div class="container">
        <h1>Hotel Registration</h1>
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