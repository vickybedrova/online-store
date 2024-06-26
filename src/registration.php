<?php
include('../config/dbcon.php');

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password fields are set
    if (isset($_POST['email_alias']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $email = (string)$_POST['email_alias'];
        $password = (string)$_POST['password'];
        $confirm_password = (string)$_POST['confirm_password'];

        // Check if password and confirm password match
        if ($password !== $confirm_password) {
            $error_message = 'Password and Confirm Password do not match.';
        } else {
            try {
                $userProperties = [
                    'email' => $email,
                    'password' => $password
                ];

                $createdUser = $auth->createUser($userProperties);
                session_start();
                $_SESSION['registration_message'] = 'User created successfully.';

                // Redirect after a longer delay if the user doesn't click manually
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "login.php";
                        }, 10000); // 10000 milliseconds = 10 seconds
                      </script>';

                // Redirect to prevent form resubmission on refresh
                header('Location: registration.php');
                exit;

            } catch (\Kreait\Firebase\Exception\AuthException $e) {
                $error_message = 'Error creating user: ' . (string)$e->getMessage();
            } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
                $error_message = 'Firebase error: ' . (string)$e->getMessage();
            }
        }
    } else {
        $error_message = 'Email, Password, and Confirm Password are required fields.';
    }
}

// Check if there's a registration message in session to trigger redirection
session_start();
if (isset($_SESSION['registration_message']) && $_SESSION['registration_message'] === 'User created successfully.') {
    $success_message = $_SESSION['registration_message'];
    unset($_SESSION['registration_message']); // Clear session message after displaying

    // Output the JavaScript redirection only on successful registration
    echo '<script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 10000); // 10000 milliseconds = 10 seconds
          </script>';
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
            <p>Please wait, you will be redirected to <a href="login.php">login page</a> after 10 seconds.</p>
        <?php endif; ?>
        
        <form action="registration.php" method="post">
            <label for="email_alias">Email:</label>
            <input type="email" name="email_alias" id="email_alias" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <input type="submit" value="Register" class="submit-btn">
        </form>

        <div class="sign-in-message">
            <p>Already registered? <a href="login.php">Sign in here</a>.</p>
        </div>
    </div>
</body>
</html>
