<?php
include '../head.php';
include '../auth/db_config.php';

// Fetch all bookings using prepared statement
try {
    $stmt = $conn->prepare("SELECT * FROM bookings ORDER BY booking_id");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} catch (Exception $e) {
    echo "Error fetching bookings: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../admin-navbar.php'; ?>
    <title>View Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-container {
            margin: 20px;
            text-align: center; /* Center the text */
            position: relative;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 40px; /* Add margin to move the table lower */
        }

        .booking-table th, .booking-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .booking-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .booking-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .booking-table tr:hover {
            background-color: #f1f1f1;
        }

        .status.confirmed {
            color: green;
        }

        .status.pending {
            color: orange;
        }

        .status.cancelled {
            color: red;
        }

        .back-btn {
            margin: 20px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            position: absolute;
            left: 20px;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <a href="../admin-index.php" class="back-btn">Back</a>
        <h2>View Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Room Number</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']);
                        echo "<tr>";
                        echo "<td>" . $row['booking_id'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['room_number'] . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['check_in_date'])) . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['check_out_date'])) . "</td>";
                        echo "<td><span class='status " . $statusClass . "'>" . $row['status'] . "</span></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>