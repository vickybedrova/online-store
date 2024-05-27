<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
</head>
<body>
    <?php

    session_start();

    // Check if registration was successful (from session variable)
    if (isset($_SESSION['registration_successful']) && $_SESSION['registration_successful'] === true) {
        echo "<h1>Welcome, you have successfully registered!</h1>";
        // Unset the session variable after displaying the message
        unset($_SESSION['registration_successful']);
    } else {
        echo "<h1>Welcome, " . (isset($_SESSION['username']) ? $_SESSION['username'] : '') . "!</h1>";
    }

    ?>

    <p>You are now logged in to District Market. Here are some options:</p>

    <ul>
        <li><a href="products.php">Browse Products</a></li>
        <li><a href="profile.php">View Profile</a></li>
        <li><a href="cart.php">View Cart</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</body>
</html>
