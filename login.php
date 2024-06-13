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
        include 'connection.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $errors = []; 

            if (empty($username)) {
                $errors[] = "Username is required.";
            }
            if (empty($password)) {
                $errors[] = "Password is required.";
            }
            if (count($errors) > 0) {
                echo "<div class='error'>";  
                echo "<b>Error:</b><br>";
                foreach ($errors as $error) {
                    echo " - " . $error . "<br>";
                }
                echo "</div>";
            } else {
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc(); 

                    if (password_verify($password, $user['password'])) {
                        session_start();

                        $_SESSION['user_id'] = $user['id']; 
                        $_SESSION['username'] = $username; 

                        header('Location: home.php');
                        exit; 
                    } else {
                        $errors[] = "Invalid username or password.";
                    }
                } else {
                    $errors[] = "Invalid username or password.";
                }

                if (count($errors) > 0) {
                    echo "<br><div class='error'><b>Login failed:</b><br>";  
                    foreach ($errors as $error) {
                        echo " - " . $error . "<br>";
                    }
                    echo "</div>";
                }
            }

            $conn->close();
        }
        ?> 
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" value="Login" class="submit-btn">
        </form>   
      </div>
</body>
</html>
