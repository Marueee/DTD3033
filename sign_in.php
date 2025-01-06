<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example credentials (replace this with database validation later)
    $valid_username = "user";
    $valid_password = "password";

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Set session variable
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password.";
        // Display the error and redirect back to the sign-in page
        echo "<script>
                alert('$error');
                window.location.href='signin.html';
              </script>";
        exit();
    }
}
?>
