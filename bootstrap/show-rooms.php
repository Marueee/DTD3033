<?php
include 'head.php';
include 'auth/db_configAzim.php';

// Fetch all rooms
$query = "SELECT * FROM rooms ORDER BY room_number";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room List</title>
    <style>
        .table-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .room-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .room-table th, .room-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .room-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .room-table tr:hover {
            background-color: #f5f5f5;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }
        
        .available {
            background-color: #d4edda;
            color: #155724;
        }
        
        .occupied {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .maintenance {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Room List</h2>
        <table class="room-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price per Night (RM)</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['availability_status']);
                        echo "<tr>";
                        echo "<td>".$row['room_number']."</td>";
                        echo "<td>".$row['room_type']."</td>";
                        echo "<td>RM ".number_format($row['price_per_night'], 2)."</td>";
                        echo "<td><span class='status ".$statusClass."'>".$row['availability_status']."</span></td>";
                        echo "<td>".date('d M Y H:i', strtotime($row['updated_at']))."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No rooms found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>