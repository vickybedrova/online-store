<?php

session_start();

include('../config/dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <?php if (1 > 0) { ?>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $item_id => $item_data) {
          $product_id = $item_id;
          $quantity = $item_data['quantity'];

          $sql = "SELECT * FROM product WHERE id = $product_id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $price = $product['price'];
            $subtotal = $price * $quantity;
            $total_price += $subtotal;
          } else {
            // Handle product not found error (remove from cart?)
          } ?>
          <tr>
            <td><?php echo $product['name']; ?></td>
            <td>$<?php echo number_format($price, 2); ?></td>
            <td><input type="number" min="1" value="<?php echo $quantity; ?>"></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
            <td><a href="update_cart.php?id=<?php echo $product_id; ?>&action=remove">Remove</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
      <a href="checkout.php">Proceed to Checkout</a>
    <?php } else { ?>
      <p>Your cart is empty!</p>
    <?php } ?>
</body>
</html>

