<?php

include('../config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email_alias']) && isset($_POST['password'])) {
        $email = (string)$_POST['email_alias'];
        $password = (string)$_POST['password'];

        try {
            $userProperties = [
                'email' => $email,
                'password' => $password
            ];

            $createdUser = $auth->createUser($userProperties);
            echo 'User created successfully. User ID: ' . (string)$createdUser->uid;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            echo 'Error creating user: ' . (string)$e->getMessage();
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            echo 'Firebase error: ' . (string)$e->getMessage();
        }
    } else {
        echo 'Email and Password are required fields.';
    }
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
        <form action="registration.php" method="post">      
            <label for="email_alias">Email:</label>
            <input type="email" name="email_alias" id="email_alias" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <input type="submit" value="Register" class="submit-btn">
        </form>
    </div>
</body>
</html>
