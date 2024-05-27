<?php

session_start();

include 'connection.php';

// Check if user is logged in and has moderator privileges 
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_moderator'])) {
  header("Location: index.php"); // Redirect to login 
  exit;
}

$product_id = $_GET['id']; 

$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();
} else {
  // Product not found, handle error
  header("Location: moderator_products.php");
  exit;
}

$update_success = false; // Flag for update success message

if (isset($_POST['update_product'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  // Sanitize user input
  $name = mysqli_real_escape_string($conn, $name); 
  $price = floatval($price); // Convert price to float
  $description = mysqli_real_escape_string($conn, $description);
  $image = mysqli_real_escape_string($conn, $image);

  $sql = "UPDATE product SET name = '$name', price = $price, description = '$description', image = '$image' WHERE id = $product_id";

  if ($conn->query($sql) === TRUE) {
    $update_success = true;
  } else {
    echo "Error updating product: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product (Moderators)</h1>

    <?php if ($update_success) { ?>
      <p style="color:green">Product updated successfully!</p>
    <?php } ?>

    <form action="edit_product.php?id=<?php echo $product['id']; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>">
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?php echo $product['price']; ?>">
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo $product['description']; ?></textarea>
        <label for="image">Image URL (optional):</label>
        <input type="text" name="image" id="image" value="<?php echo $product['image']; ?>">
        <input type="submit" name="update_product" value="Update Product">
    </form>

</body>
</html>

