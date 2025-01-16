<?php
include 'auth/db_config.php';
include 'head.php';
// Check if user is logged in and has admin role
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login/logins.php');
    exit();
}

// Handle Delete
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $_POST['user_id']);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error deleting user: " . $e->getMessage();
    }
}

// Handle Update
if (isset($_POST['update']) && isset($_POST['user_id'])) {
    try {
        $stmt = $conn->prepare("UPDATE users SET username=?, name=?, phone=?, role=? WHERE user_id=?");
        $stmt->bind_param(
            "ssssi",
            $_POST['username'],
            $_POST['name'],
            $_POST['phone'],
            $_POST['role'],
            $_POST['user_id']
        );
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error updating user: " . $e->getMessage();
    }
}

// Fetch all users
$stmt = $conn->prepare("SELECT * FROM users ORDER BY user_id");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'admin-navbar.php'; ?>
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-container {
            margin: 20px;
            text-align: center;
            position: relative;
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }
        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .user-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            cursor: pointer;
        }
        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .user-table tr:hover {
            background-color: #f1f1f1;
        }
        .role.admin { color: red; }
        .role.user { color: green; }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
        }
        .edit-btn {
            background-color: #007bff;
            color: white;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
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
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Manage Users</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">User ID ⇅</th>
                    <th onclick="sortTable(1)">Username ⇅</th>
                    <th onclick="sortTable(2)">Name ⇅</th>
                    <th onclick="sortTable(3)">Phone ⇅</th>
                    <th onclick="sortTable(4)">Role ⇅</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><span class="role <?php echo $row['role']; ?>"><?php echo $row['role']; ?></span></td>
                        <td>
                            <button class="edit-btn" onclick="editUser(<?php echo $row['user_id']; ?>)">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="delete-btn" onclick="deleteUser(<?php echo $row['user_id']; ?>)">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit User</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="edit_username" required>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" id="edit_phone" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="edit_role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="update" class="submit-btn">Update User</button>
                <button type="button" onclick="closeModal()" class="submit-btn">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editUser(userId) {
            const modal = document.getElementById('editModal');
            const row = event.target.closest('tr');
            
            if (row) {
                document.getElementById('edit_user_id').value = userId;
                document.getElementById('edit_username').value = row.cells[1].textContent.trim();
                document.getElementById('edit_name').value = row.cells[2].textContent.trim();
                document.getElementById('edit_phone').value = row.cells[3].textContent.trim();
                document.getElementById('edit_role').value = row.cells[4].textContent.toLowerCase().trim();
                
                modal.classList.add('show');
            } else {
                console.error('Row not found');
            }
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `<input name="delete" value="1"><input name="user_id" value="${userId}">`;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function closeModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        function sortTable(n) {
            // ... same sorting function as in rooms management ...
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
