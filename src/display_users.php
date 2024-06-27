<?php
include('../config/dbcon.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $idToken = $_SESSION['user_id'];
} else {
    echo "Firebase ID token not found in session.";
    exit();
}

try {
    // Retrieve user's custom claims
    $userRecord = $auth->getUser($idToken);
    $customClaims = $userRecord->customClaims;

    // Check if user is admin
    if (!isset($customClaims['admin']) || !$customClaims['admin']) {
        // Redirect or deny access if not admin
        header('HTTP/1.0 403 Forbidden');
        echo '403 Forbidden: You are not authorized to access this page.';
        exit();
    }
} catch (\Exception $e) {
    // Handle errors
    echo 'Error: ' . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['uid']) && isset($_POST['role'])) {
        $uid = $_POST['uid'];
        $role = $_POST['role'];

        // Set custom claims based on role
        $customClaims = [
            'admin' => ($role === 'admin'), // Set 'admin' claim based on role selection
        ];

        try {
            $auth->setCustomUserClaims($uid, $customClaims);
            echo "Custom claims have been set for user with UID: $uid" . PHP_EOL;
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            echo 'User not found' . PHP_EOL;
        } catch (\Exception $e) {
            echo 'Error setting custom claims: ' . $e->getMessage() . PHP_EOL;
        }
    }
}

// List all users
$users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage User Roles</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Manage User Roles</h2>
    <table>
        <tr>
            <th>UID</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $userRecord): ?>
            <tr>
                <td><?php echo $userRecord->uid; ?></td>
                <td><?php echo $userRecord->email; ?></td>
                <td><?php echo isset($userRecord->customClaims['admin']) && $userRecord->customClaims['admin'] ? 'Admin' : 'User'; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="uid" value="<?php echo $userRecord->uid; ?>">
                        <select name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <button type="submit">Set Role</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
