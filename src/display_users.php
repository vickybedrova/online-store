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

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $uidToDelete = $_POST['delete_user'];
    
    try {
        // Delete the user
        $auth->deleteUser($uidToDelete);
        echo "User with UID: $uidToDelete has been successfully deleted.";
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        echo "User with UID: $uidToDelete not found.";
    } catch (\Exception $e) {
        echo 'Error deleting user: ' . $e->getMessage();
    }
}

// List all users
$users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <br>
    <br>
    <br>
    <title>Manage User Roles</title>
    <?php include 'navigation-bar.php'; ?>

    <style>
        /* Navbar styles */
        .navbar {
            width: 100%;
            background: rgba(0, 0, 0, 0.59);
            padding: 1em 0;
            text-align: center;
            position: fixed; 
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            font-size: 1.5em;
            color: #fff;
            margin-left: 20px;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .nav-list li {
            margin: 0 1em;
        }

        .nav-list a {
            color: #fff;
            text-decoration: none;
            font-size: 1em;
            padding: 0.5em 1em;
            transition: background 0.3s, color 0.3s;
            border-radius: 4px;
        }

        .nav-list a:hover {
            background: #555;
            color: #fff;
        }
        .nav-list span {
            color: #fff; 
        }

        /* Table styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 50px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: inline-block;
            margin-right: 5px;
        }

        select, button {
            padding: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar"> 
        <ul class="nav-list">
            <li><a href="products.php">Browse Products</a></li>
            <li><a href="profile.php">View Profile</a></li>
            <li><a href="cart.php">View Cart</a></li>
            <li>
                <?php
                $username = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
                if ($username) {
                    echo '<span>Logged in as: ' . htmlspecialchars($username) . '!</span>';
                }
                ?>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container">
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
                        <form method="post">
                            <input type="hidden" name="delete_user" value="<?php echo $userRecord->uid; ?>">
                            <button type="submit">Delete User</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
