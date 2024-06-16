<?php

session_start();

include 'connection.php'; 

if (!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
  // User has no cart or is not logged in, redirect
  header("Location: index.php");
  exit;
}

$cart_items = $_SESSION['cart'];
$user_id = $_SESSION['user_id'];

// Get user address
$sql = "SELECT address FROM user_address WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $user_address = $result->fetch_assoc()["address"];
} else {
  // Handle missing address 
  echo "<h1>Missing Address!</h1>";
  echo "<p>Please enter your shipping address before checkout.</p>";
  echo "<a href='user_profile.php'>Update Profile</a>"; // Profile update page
  exit;
}

$order_date = date("Y-m-d H:i:s"); // Current date and time
$total_price = 0;

try {
  // Start database transaction
  $conn->beginTransaction();

  // Insert order record
  $sql = "INSERT INTO `order` (user_id, order_date, order_address, total_price) VALUES ($user_id, '$order_date', '$user_address', $total_price)";
  $conn->exec($sql);
  $order_id = $conn->lastInsertId();

  // Insert order items
  foreach ($cart_items as $item_id => $item_data) {
    $product_id = $item_id;
    $quantity = $item_data['quantity'];

    $sql = "SELECT price FROM product WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $price = $result->fetch_assoc()["price"];
      $subtotal = $price * $quantity;
      $total_price += $subtotal;

      $sql = "INSERT INTO `order_items` (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
      $conn->exec($sql);
    } else {
      // Handle product not found error
      echo "<p>Warning: Product with ID $item_id not found in cart!</p>";
      // Remove the item from the cart session
      unset($_SESSION['cart'][$item_id]);
    }
  }

  // Update total price in the order record
  $sql = "UPDATE `order` SET total_price = $total_price WHERE id = $order_id";
  $conn->exec($sql);

  // Commit the transaction
  $conn->commit();

  // Clear the cart after successful order
  unset($_SESSION['cart']);

  echo "<h1>Order successful!</h1>";
  echo "<p>Your order ID: $order_id</p>";
  // Optionally, display order details or allow user to view order history

} catch(PDOException $e) {
  // Rollback the transaction on error
  $conn->rollBack();

  echo "Error processing your order: " . $e->getMessage();
}

?>
