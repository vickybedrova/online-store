<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        // Include Firebase PHP SDK and initialize Firebase Auth
        require '../vendor/autoload.php';
        use Kreait\Firebase\Factory;
        use Kreait\Firebase\Auth;

        // Initialize Firebase Auth
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/../config/firebase_credentials.json');
        $auth = $factory->createAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Email']) && isset($_POST['password'])) {
                $Email = $_POST['Email'];
                $password = $_POST['password'];

                try {
                    // Authenticate user with Firebase
                    $signInResult = $auth->signInWithEmailAndPassword($Email, $password);

                    // You can get the user information like email, UID, etc., from the user object
                    $user = $signInResult->data(); // This retrieves the user data as an array

                    // Successful login
                    session_start();
                    $_SESSION['user_id'] = $user['localId']; // Store user ID in session
                    $_SESSION['Email'] = $user['email']; // Store Email in session
                    
                    header('Location: home.php'); // Redirect to home page after successful login
                    exit;
                } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
                    echo '<div class="error">Invalid Email or password. Please try again.</div>';
                } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
                    echo '<div class="error">Firebase error: ' . $e->getMessage() . '</div>';
                }
            } else {
                echo '<div class="error">Email and password are required fields.</div>';
            }
        }
        ?>
        <form action="login.php" method="post">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" value="Login" class="submit-btn">
        </form>
    </div>
</body>
</html>
