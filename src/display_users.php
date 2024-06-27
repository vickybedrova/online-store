<?php
// Include Firebase PHP SDK and initialize Firebase Auth
require '../vendor/autoload.php'; 
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

include('../config/dbcon.php');

// Function to delete a user by UID
function deleteUser($auth, $uid) {
    try {
        $auth->deleteUser($uid);
        return true;
    } catch (\Kreait\Firebase\Exception\AuthException $e) {
        // Handle deletion error
        echo 'Error deleting user: ' . $e->getMessage();
        return false;
    }
}

// Retrieve all users from Firebase Authentication
$users = $auth->listUsers($defaultMaxResults = 1000); // Adjust max results as necessary

// Handle form submission to delete user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $uidToDelete = $_POST['delete_user'];
    if (deleteUser($auth, $uidToDelete)) {
        echo "<div>User with UID: $uidToDelete successfully deleted.</div>";
    }
}

// Display the users
if (!empty($users)) {
    echo "<h2>Registered Users:</h2>";
    echo "<ul>";
    foreach ($users as $user) {
        $uid = $user->uid;
        $email = htmlspecialchars($user->email);
        echo "<li>Email: $email 
              <form method='post'>
                  <input type='hidden' name='delete_user' value='$uid'>
                  <button type='submit'>Delete</button>
              </form>
              </li>";
    }
    echo "</ul>";
} else {
    echo "No registered users found.";
}
?>
