<?php
session_start(); // Start the session to access session variables

unset($_SESSION['student_id']); // Unset a specific session variable, if needed
session_destroy(); // Destroy the entire session

header('location:../../index.php'); // Redirect to another page
exit(); // Always use exit() after header to stop further script execution
?>