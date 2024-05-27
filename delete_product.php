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

$delete_success = false; // Flag for delete success message

if (isset($_POST['delete_product'])) {
  $sql = "DELETE FROM product WHERE id = $product_id";

  if ($conn->query($sql) === TRUE) {
    $delete_success = true;
  } else {
    echo "Error deleting product: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
</head>
<body>
    <h1>Delete Product (Moderators)</h1>

    <?php if ($delete_success) { ?>
      <p style="color:green">Product deleted successfully!</p>
    <?php } ?>

    <p>Are you sure you want to delete the product: "<?php echo $product['name']; ?>"?</p>

    <form action="delete_product.php?id=<?php echo $product['id']; ?>" method="post">
        <input type="submit" name="delete_product" value="Yes, Delete Product">
        <a href="moderator_products.php">Cancel</a>
    </form>

</body>
</html>
