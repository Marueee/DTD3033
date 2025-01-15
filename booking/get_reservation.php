<?php
include '../auth/db_config.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT reservations.*, users.name AS customer_name, rooms.room_number 
                           FROM reservations 
                           JOIN users ON reservations.user_id = users.user_id 
                           JOIN rooms ON reservations.room_id = rooms.room_id 
                           WHERE reservations.reservation_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    // Format the response
    $response = [
        'reservation_id' => $data['reservation_id'],
        'user_id' => $data['user_id'],
        'room_id' => $data['room_id'],
        'room_number' => $data['room_number'],
        'checkin_date' => $data['checkin_date'],
        'checkout_date' => $data['checkout_date'],
        'status' => $data['reservation_status']
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
