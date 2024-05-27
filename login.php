<?php

include 'connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $errors = []; // Array to store any validation or login errors

  // Validate username
  if (empty($username)) {
    $errors[] = "Username is required.";
  }

  // Validate password
  if (empty($password)) {
    $errors[] = "Password is required.";
  }

  // Check for any validation errors
  if (count($errors) > 0) {
    // Display error messages to the user
    echo "<b>Error:</b><br>";
    foreach ($errors as $error) {
      echo " - " . $error . "<br>";
    }
  } else {
    // Search the user in the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc(); // Get user data

      // Verify password
      if (password_verify($password, $user['password'])) {
        session_start(); // Start the session

        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['username'] = $username; // Store username in session

        header('Location: products.php'); 
        exit; // Stop script execution after redirect
      } else {
        $errors[] = "Invalid username or password.";
      }
    } else {
      $errors[] = "Invalid username or password.";
    }

    if (count($errors) > 0) {
      echo "<br><b>Login failed:</b><br>";
      foreach ($errors as $error) {
        echo " - " . $error . "<br>";
      }
    }
  }

  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
