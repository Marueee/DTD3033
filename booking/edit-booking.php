<?php
include '../head.php';
include '../auth/db_config.php';

// Handle Update
if (isset($_POST['update']) && isset($_POST['reservation_id'])) {
    try {
        // Validate inputs
        if (!isset($_POST['customer_name'], $_POST['room_number'], $_POST['checkin_date'], $_POST['checkout_date'], $_POST['status'])) {
            throw new Exception("All fields are required");
        }

        // Use prepared statement
        $stmt = $conn->prepare("UPDATE reservations SET customer_name=?, room_number=?, checkin_date=?, checkout_date=?, status=? WHERE reservation_id=?");
        $stmt->bind_param(
            "sssssi",
            $_POST['customer_name'],
            $_POST['room_number'],
            $_POST['checkin_date'],
            $_POST['checkout_date'],
            $_POST['status'],
            $_POST['reservation_id']
        );
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error updating reservation: " . $e->getMessage();
    }
}

// Fetch all reservations using prepared statement
try {
    $query = "SELECT reservations.reservation_id, users.name AS customer_name, rooms.room_number, reservations.checkin_date, reservations.checkout_date, reservations.status 
              FROM reservations 
              JOIN users ON reservations.user_id = users.user_id 
              JOIN rooms ON reservations.room_id = rooms.room_id 
              ORDER BY reservations.reservation_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} catch (Exception $e) {
    echo "Error fetching reservations: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../admin-navbar.php'; ?>
    <title>Edit Reservation</title>
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
    </style>
</head>

<body>
    <div class="table-container">
        <a href="../admin-index.php" class="back-btn">Back</a>
        <h2>Manage Reservations</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Customer Name</th>
                    <th>Room Number</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']);
                        echo "<tr>";
                        echo "<td>" . $row['reservation_id'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['room_number'] . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['checkin_date'])) . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['checkout_date'])) . "</td>";
                        echo "<td><span class='status " . $statusClass . "'>" . $row['status'] . "</span></td>";
                        echo "<td class='action-buttons'>
                                <button class='edit-btn' onclick='editReservation(" . $row['reservation_id'] . ")'><i class='fas fa-edit'></i> Edit</button>
                                <button class='delete-btn' onclick='deleteReservation(" . $row['reservation_id'] . ")'><i class='fas fa-trash'></i> Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Reservation</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="reservation_id" id="edit_reservation_id">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" id="edit_customer_name" required>
                </div>
                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="room_number" id="edit_room_number" required>
                </div>
                <div class="form-group">
                    <label>Check-in Date</label>
                    <input type="date" name="checkin_date" id="edit_checkin_date" required>
                </div>
                <div class="form-group">
                    <label>Check-out Date</label>
                    <input type="date" name="checkout_date" id="edit_checkout_date" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="edit_status" required>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" name="update" class="submit-btn">Update Reservation</button>
                <button type="button" onclick="closeModal()" class="submit-btn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editReservation(reservationId) {
            // Show modal
            document.getElementById('editModal').classList.add('show');
            document.getElementById('edit_reservation_id').value = reservationId;

            // Fetch reservation data via AJAX
            fetch(`get_reservation.php?id=${reservationId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_customer_name').value = data.customer_name;
                    document.getElementById('edit_room_number').value = data.room_number;
                    document.getElementById('edit_checkin_date').value = data.checkin_date;
                    document.getElementById('edit_checkout_date').value = data.checkout_date;
                    document.getElementById('edit_status').value = data.status;
                });
        }

        function deleteReservation(reservationId) {
            if (confirm('Are you sure you want to delete this reservation?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `<input name="delete" value="1"><input name="reservation_id" value="${reservationId}">`;
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
