<?php

session_start();

include 'connection.php';
$product_id = $_GET['id']; 

$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
</head>
<body>
    <?php if ($result->num_rows > 0) {
      $product = $result->fetch_assoc(); ?>
        <h1><?php echo $product['name']; ?></h1>
        <img src="<?php echo $product['image']; // Assuming an image field exists ?>" alt="<?php echo $product['name']; ?>">
        <p><?php echo $product['description']; ?></p>
        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>

        <?php if (isset($_SESSION['user_id'])) { // Check if user is logged in ?>
          <form action="add_to_cart.php" method="post">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" min="1" value="1">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="submit" value="Add to Cart">
          </form>
        <?php } else { ?>
          <p>Please log in to add to cart.</p>
        <?php } ?>

      <?php } else { ?>
        <p>Product not found!</p>
      <?php } ?>
</body>
</html>

