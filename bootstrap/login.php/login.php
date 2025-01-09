<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example credentials (you can replace this with database validation)
    $valid_username = "user";
    $valid_password = "password";

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Set session variable
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

