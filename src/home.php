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

        // Check if registration was successful (from session variable)
        if (isset($_SESSION['registration_successful'])) {
            unset($_SESSION['registration_successful']);
        }
        
        // Display a generic welcome message
        echo "<h1>Welcome!</h1>";
        ?>

        <p>You are now logged in to District Market</p>

        
    </div>
</body>
</html>
