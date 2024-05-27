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
  // User not found
  echo "Error: User not found!";
}

$update_success = false; // Flag for update success message

if (isset($_POST['update_profile'])) {
  $username = $_POST['username'];
  $email_alias = $_POST['email_alias'];
  $phone_alias = $_POST['phone_alias'];

  // Prepare the update statement
  $sql = "UPDATE users SET username = ?, email_alias = ?, phone_alias = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);

  // Bind parameters to the statement
  $stmt->bind_param("ssss", $username, $email_alias, $phone_alias, $user_id);

  if ($stmt->execute()) {
    $update_success = true;
  } else {
    echo "Error updating profile: " . $conn->error;
  }

  // Close the statement after execution
  $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $user['username']; ?></h1>

    <?php if ($update_success) { ?>
      <p style="color:green">Profile updated successfully!</p>
    <?php } ?>

    <form action="user_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
        <label for="email_alias">Email:</label>
        <input type="email" name="email_alias" id="email_alias" value="<?php echo $user['email_alias']; ?>">
        <label for="phone_alias">Phone (optional):</label>
        <input type="tel" name="phone_alias" id="phone_alias" value="<?php echo $user['phone_alias']; ?>">
        <input type="submit" name="update_profile" value="Update Profile">
    </form>

    </body>
</html>

