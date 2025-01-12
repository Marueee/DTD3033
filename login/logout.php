<?php
// Destroy session or perform any necessary cleanup.
session_start();
session_destroy();
header("Location: ../index.php");
exit();
?>
