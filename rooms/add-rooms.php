<?php
include 'head.php';
include 'auth/db_config.php';

$error = '';
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get and validate form data
    $room_number = isset($_POST['room_number']) ? trim($_POST['room_number']) : '';
    $room_type = isset($_POST['room_type']) ? trim($_POST['room_type']) : '';
    $price = isset($_POST['price_per_night']) ? floatval($_POST['price_per_night']) : 0;
    $status = isset($_POST['availability_status']) ? trim($_POST['availability_status']) : '';

    // Validate required fields
    if (empty($room_number) || empty($room_type) || $price <= 0 || empty($status)) {
        $error = "All fields are required and price must be greater than 0";
    } else {
        try {
            // Prepare statement
            $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, price_per_night, availability_status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $room_number, $room_type, $price, $status);
            
            if ($stmt->execute()) {
                $success = "Room added successfully!";
            } else {
                $error = "Error adding room: " . $stmt->error;
            }
            $stmt->close();
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Room</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Room</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="room_number">Room Number</label>
                <input type="text" id="room_number" name="room_number" required>
            </div>
            
            <div class="form-group">
                <label for="room_type">Room Type</label>
                <select id="room_type" name="room_type" required>
                    <option value="">Select Room Type</option>
                    <option value="King Room">King Room</option>
                    <option value="Suite Room">Suite Room</option>
                    <option value="Family Room">Family Room</option>
                    <option value="Deluxe Room">Deluxe Room</option>
                    <option value="Luxury Room">Luxury Room</option>
                    <option value="Superior Room">Superior Room</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="price_per_night">Price Per Night (RM)</label>
                <input type="number" id="price_per_night" name="price_per_night" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="availability_status">Availability Status</label>
                <select id="availability_status" name="availability_status" required>
                    <option value="">Select Status</option>
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            
            <button type="submit" name="submit" class="submit-btn">Add Room</button>
        </form>
    </div>
</body>
</html>