<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            color: #343a40;
        }
        p {
            color: #6c757d;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin: 1em 0;
        }
        ul li a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>
