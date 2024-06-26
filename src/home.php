<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class=home>
<?php include 'navigation-bar.php'; ?>

    <div class="container">
        <?php
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }
        
        // Retrieve username from session
        $username = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';

        ?>

        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>You are now logged in to District Market</p>

    </div>
</body>
</html>
