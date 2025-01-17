<?php
include 'head.php';
include '../auth/db_config.php';

// Get sorting parameters
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'room_number';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Add room type filter
$room_type_filter = isset($_GET['room_type']) ? $_GET['room_type'] : '';
$valid_room_types = ['King Room', 'Suite Room', 'Family Room', 'Deluxe Room', 'Luxury Room', 'Superior Room'];

// Validate sort column to prevent SQL injection
$allowed_sort_columns = ['room_number', 'room_type', 'price_per_night', 'status', 'updated_at'];
if (!in_array($sort, $allowed_sort_columns)) {
    $sort = 'room_number';
}

// Toggle sort order
$new_order = ($order === 'ASC') ? 'DESC' : 'ASC';

// Pagination settings
$limit = 10; // Number of entries to show in a page.
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $limit;

// Modify query to only use room_type filter
try {
    $query = "SELECT * FROM rooms WHERE 1=1";
    $params = [];
    $types = "";

    if (!empty($room_type_filter)) {
        $query .= " AND room_type = ?";
        $params[] = $room_type_filter;
        $types .= "s";
    }

    $query .= " ORDER BY $sort $order LIMIT ?, ?";
    $params[] = $start_from;
    $params[] = $limit;
    $types .= "ii";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Get total number of records
$total_records_query = "SELECT COUNT(*) FROM rooms WHERE 1=1";
if (!empty($room_type_filter)) {
    $total_records_query .= " AND room_type = ?";
}
$stmt = $conn->prepare($total_records_query);
if (!empty($room_type_filter)) {
    $stmt->bind_param("s", $room_type_filter);
}
$stmt->execute();
$total_records_result = $stmt->get_result();
$total_records = $total_records_result->fetch_row()[0];
$total_pages = ceil($total_records / $limit);
$stmt->close();

// Sort indicator arrows
function getSortIndicator($column, $currentSort, $currentOrder) {
    if ($column === $currentSort) {
        return ($currentOrder === 'ASC') ? ' ↑' : ' ↓';
    }
    return '';
}
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

        .room-table th a {
            color: #333;
            text-decoration: none;
            display: block;
            position: relative;
            padding-right: 20px;
        }
        
        .room-table th a:hover {
            color: #007bff;
        }

        .search-container {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .search-form {
            display: flex;
            justify-content: center;
        }

        .search-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-form input,
        .search-form select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
        }

        .search-form button {
            padding: 8px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background: #0056b3;
        }

        .room-table th a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        .sort-icon {
            margin-left: 5px;
            font-size: 0.8em;
        }

        .room-table th:hover a {
            background-color: #f5f5f5;
        }

        .search-container {
            margin: 20px 0;
            text-align: center;
        }

        .search-form {
            display: inline-block;
        }

        .search-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .search-form select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
            font-size: 16px;
        }

        .search-form button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-form button:hover {
            background: #0056b3;
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
        <h2>Room List</h2>
        <div class="search-container">
            <form method="GET" class="search-form">
                <div class="search-inputs">
                    <select name="room_type">
                        <option value="">All Room Types</option>
                        <?php foreach($valid_room_types as $type): ?>
                            <option value="<?php echo $type; ?>" <?php echo ($room_type_filter === $type) ? 'selected' : ''; ?>>
                                <?php echo $type; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>
        <table class="room-table">
            <thead>
                <tr>
                    <th><a href="?sort=room_number&order=<?php echo ($sort === 'room_number') ? $new_order : 'ASC'; ?>&room_type=<?php echo urlencode($room_type_filter); ?>">
                        Room Number<?php echo getSortIndicator('room_number', $sort, $order); ?>
                    </a></th>
                    <th><a href="?sort=room_type&order=<?php echo ($sort === 'room_type') ? $new_order : 'ASC'; ?>&room_type=<?php echo urlencode($room_type_filter); ?>">
                        Room Type<?php echo getSortIndicator('room_type', $sort, $order); ?>
                    </a></th>
                    <th><a href="?sort=price_per_night&order=<?php echo ($sort === 'price_per_night') ? $new_order : 'ASC'; ?>&room_type=<?php echo urlencode($room_type_filter); ?>">
                        Price per Night (RM)<?php echo getSortIndicator('price_per_night', $sort, $order); ?>
                    </a></th>
                    <th><a href="?sort=status&order=<?php echo ($sort === 'status') ? $new_order : 'ASC'; ?>&room_type=<?php echo urlencode($room_type_filter); ?>">
                        Status<?php echo getSortIndicator('status', $sort, $order); ?>
                    </a></th>
                    <th><a href="?sort=updated_at&order=<?php echo ($sort === 'updated_at') ? $new_order : 'ASC'; ?>&room_type=<?php echo urlencode($room_type_filter); ?>">
                        Last Updated<?php echo getSortIndicator('updated_at', $sort, $order); ?>
                    </a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['status']);
                        echo "<tr>";
                        echo "<td>".$row['room_number']."</td>";
                        echo "<td>".$row['room_type']."</td>";
                        echo "<td>RM ".number_format($row['price_per_night'], 2)."</td>";
                        echo "<td><span class='status ".$statusClass."'>".$row['status']."</span></td>";
                        echo "<td>".date('d M Y H:i', strtotime($row['updated_at']))."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No rooms found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            if ($page > 1) {
                echo "<a href='show-rooms.php?page=" . ($page - 1) . "&sort=" . $sort . "&order=" . $order . "&room_type=" . urlencode($room_type_filter) . "'>&laquo;</a>";
            }
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='show-rooms.php?page=" . $i . "&sort=" . $sort . "&order=" . $order . "&room_type=" . urlencode($room_type_filter) . "'";
                if ($i == $page) echo " class='active'";
                echo ">" . $i . "</a>";
            }
            if ($page < $total_pages) {
                echo "<a href='show-rooms.php?page=" . ($page + 1) . "&sort=" . $sort . "&order=" . $order . "&room_type=" . urlencode($room_type_filter) . "'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>