<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'navigation-bar.php'; ?>

    <style>
        /* Adjustments to match the products.php styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>

        <?php
        // Include Firebase PHP SDK and initialize Firebase Auth
        require '../vendor/autoload.php';
        use Kreait\Firebase\Factory;
        use Kreait\Firebase\Auth;

        // Initialize Firebase Auth
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/../config/firebase_credentials.json');
        $auth = $factory->createAuth();

        session_start();

        // Check if the user is logged in by checking the session variable
        if (isset($_SESSION['user_id'])) {
            try {
                // Get user info using the stored user_id
                $user = $auth->getUser($_SESSION['user_id']);

                // Display user's email
                echo "<p>Logged in as: {$user->email}</p>";
            } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                echo '<div class="error">User not found.</div>';
            } catch (\Throwable $e) {
                echo '<div class="error">Error: ' . $e->getMessage() . '</div>';
            }
        } else {
            // If user is not logged in, redirect to login page
            header('Location: login.php');
            exit;
        }
        ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
