<!-- Navigation bar -->

<nav class="navbar"> 
    
    <ul class="nav-list">
        <li><a href="products.php">Browse Products</a></li>
        <li><a href="profile.php">View Profile</a></li>
        <li><a href="cart.php">View Cart</a></li>
        <li>
            <?php
            session_start();
            $username = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
            if ($username) {
                echo '<span>Logged in as: ' . htmlspecialchars($username) . '!</span>';
            }
            ?>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</nav>