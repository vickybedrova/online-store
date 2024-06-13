<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email_alias = mysqli_real_escape_string($conn, $_POST['email_alias']);
    $phone_alias = mysqli_real_escape_string($conn, $_POST['phone_alias']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $errors = []; 

    if (empty($username)) {
        $errors[] = "Username is required.";
    } else if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }

    if (empty($email_alias)) {
        $errors[] = "Email is required.";
    } else if (!filter_var($email_alias, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } else if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } else if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    $username_check_sql = "SELECT * FROM users WHERE username = '$username'";
    $username_check_result = $conn->query($username_check_sql);

    if ($username_check_result->num_rows > 0) {
        $errors[] = "Username already exists. Please choose a different username.";
    }

    if (count($errors) > 0) {
        echo "<b>Error:</b><br>";
        foreach ($errors as $error) {
            echo " - " . $error . "<br>";
        }
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

        $sql = "INSERT INTO users (username, email_alias, phone_alias, password, role, created_at) VALUES ('$username', '$email_alias', '$phone_alias', '$hashed_password', 'user', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $conn->error;
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
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <?php
        if (isset($errors) && count($errors) > 0) {
            echo '<div class="error">';
            echo '<b>Error:</b><br>';
            foreach ($errors as $error) {
                echo ' - ' . $error . '<br>';
            }
            echo '</div>';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
            echo '<div class="success">Registration successful!</div>';
        }
        ?>
        <form action="registration.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="email_alias">Email:</label>
            <input type="email" name="email_alias" id="email_alias" required>
            
            <label for="phone_alias">Phone (optional):</label>
            <input type="tel" name="phone_alias" id="phone_alias">
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <input type="submit" value="Register" class="submit-btn">
        </form>
    </div>
</body>
</html>
