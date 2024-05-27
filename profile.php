<?php

session_start();

include 'connection.php';

if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect to login page
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
} else {
  // User not found, handle error
  echo "Error: User not found!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $user['username']; ?></h1>
    <form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
        <label for="email_alias">Email:</label>
        <input type="email" name="email_alias" id="email_alias" value="<?php echo $user['email_alias']; ?>">
        <label for="phone_alias">Phone (optional):</label>
        <input type="tel" name="phone_alias" id="phone_alias" value="<?php echo $user['phone_alias']; ?>">
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>