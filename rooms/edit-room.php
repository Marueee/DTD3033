<?php
include 'head.php';
include '../auth/db_config.php';

// Check if user is logged in and has admin role
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Define valid room types
$valid_room_types = ['King Room', 'Suite Room', 'Family Room', 'Deluxe Room', 'Luxury Room', 'Superior Room'];

// Handle Delete
if (isset($_POST['delete']) && isset($_POST['room_id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
        $stmt->bind_param("i", $_POST['room_id']);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error deleting room: " . $e->getMessage();
    }
}

// Handle Update
if (isset($_POST['update']) && isset($_POST['room_id'])) {
    try {
        // Validate inputs
        if (!isset($_POST['room_number'], $_POST['room_type'], $_POST['price_per_night'], $_POST['status'])) {
            throw new Exception("All fields are required");
        }

        // Validate room type
        if (!in_array($_POST['room_type'], $valid_room_types)) {
            throw new Exception("Invalid room type");
        }

        // Use prepared statement
        $stmt = $conn->prepare("UPDATE rooms SET room_number=?, room_type=?, price_per_night=?, status=? WHERE room_id=?");
        $stmt->bind_param(
            "ssdsi",
            $_POST['room_number'],
            $_POST['room_type'],
            $_POST['price_per_night'],
            $_POST['status'],
            $_POST['room_id']
        );
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error updating room: " . $e->getMessage();
    }
}

// Pagination settings
$limit = 10; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

// Fetch all rooms using prepared statement with pagination
try {
    $stmt = $conn->prepare("SELECT * FROM rooms ORDER BY room_number LIMIT ?, ?");
    $stmt->bind_param("ii", $start_from, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} catch (Exception $e) {
    echo "Error fetching rooms: " . $e->getMessage();
}

// Get total number of records
$total_records_query = "SELECT COUNT(*) FROM rooms";
$total_records_result = $conn->query($total_records_query);
$total_records = $total_records_result->fetch_row()[0];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'admin-navbar.php'; ?>
    <title>Edit Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-container {
            margin: 20px;
            text-align: center; /* Center the text */
            position: relative;
        }

        .room-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 40px; /* Add margin to move the table lower */
        }

        .room-table th, .room-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .room-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .room-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .room-table tr:hover {
            background-color: #f1f1f1;
        }

        .status.available {
            color: green;
        }

        .status.occupied {
            color: red;
        }

        .status.maintenance {
            color: orange;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            background-color: #007bff;
            color: white;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: modalFade 0.3s ease-in-out;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal .form-group {
            margin-bottom: 15px;
        }

        .modal label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal input,
        .modal select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal .submit-btn {
            margin: 5px;
            padding: 8px 15px;
        }

        .modal button[type="submit"] {
            background: #007bff;
            color: white;
        }

        .modal button[onclick="closeModal()"] {
            background: #6c757d;
            color: white;
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <a href="rooms-admin.php" class="back-btn">Back</a>
        <h2>Manage Rooms</h2>
        <table class="room-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price per Night (RM)</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']);
                        echo "<tr>";
                        echo "<td>" . $row['room_number'] . "</td>";
                        echo "<td>" . $row['room_type'] . "</td>";
                        echo "<td>RM " . number_format($row['price_per_night'], 2) . "</td>";
                        echo "<td><span class='status " . $statusClass . "'>" . $row['status'] . "</span></td>";
                        echo "<td>" . date('d M Y H:i', strtotime($row['updated_at'])) . "</td>";
                        echo "<td class='action-buttons'>
                                <button class='edit-btn' onclick='editRoom(" . $row['room_id'] . ")'><i class='fas fa-edit'></i> Edit</button>
                                <button class='delete-btn' onclick='deleteRoom(" . $row['room_id'] . ")'><i class='fas fa-trash'></i> Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='edit-room.php?page=" . $i . "'";
                if ($i == $page) echo " class='active'";
                echo ">" . $i . "</a>";
            }
            ?>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Room</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="room_id" id="edit_room_id">
                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="room_number" id="edit_room_number" required>
                </div>
                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" id="edit_room_type" required>
                        <option value="King Room">King Room</option>
                        <option value="Suite Room">Suite Room</option>
                        <option value="Family Room">Family Room</option>
                        <option value="Deluxe Room">Deluxe Room</option>
                        <option value="Luxury Room">Luxury Room</option>
                        <option value="Superior Room">Superior Room</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price Per Night (RM)</label>
                    <input type="number" name="price_per_night" id="edit_price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="edit_status" required>
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <button type="submit" name="update" class="submit-btn">Update Room</button>
                <button type="button" onclick="closeModal()" class="submit-btn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editRoom(roomId) {
            // Show modal
            document.getElementById('editModal').classList.add('show');
            document.getElementById('edit_room_id').value = roomId;

            // Fetch room data via AJAX
            fetch(`get_room.php?id=${roomId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_room_number').value = data.room_number;
                    document.getElementById('edit_room_type').value = data.room_type;
                    document.getElementById('edit_price').value = data.price_per_night;
                    document.getElementById('edit_status').value = data.status;
                });
        }

        function deleteRoom(roomId) {
            if (confirm('Are you sure you want to delete this room?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `<input name="delete" value="1"><input name="room_id" value="${roomId}">`;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function closeModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeModal();
            }
        }
    </script>
</body>

</html>