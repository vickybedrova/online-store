<?php

include('../config/dbcon.php');

$error_message = '';
$success_message = '';

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
            $success_message = 'User created successfully. User ID: ' . (string)$createdUser->uid;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            $error_message = 'Error creating user: ' . (string)$e->getMessage();
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            $error_message = 'Firebase error: ' . (string)$e->getMessage();
        }
    } else {
        $error_message = 'Email and Password are required fields.';
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
        <?php if ($error_message): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php elseif ($success_message): ?>
            <div class="success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <form action="registration.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
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
