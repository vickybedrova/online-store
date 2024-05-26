<?php
session_start();

// Check if the user is logged in (replace 'user_email' with your actual session variable)
if (!isset($_SESSION['user_email'])) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit();
}

?>