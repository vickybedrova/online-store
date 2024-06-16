<?php

session_start();

include 'connection.php'; // Include database connection file

// Check if user is logged in and has moderator privileges (replace with your authorization logic)
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_moderator'])) {
  header("Location: index.php"); // Redirect to login or another appropriate page
  exit;
}

$sql = "SELECT * FROM product"; // Assuming a product table
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
</head>
<body>
    <h1>Product Management (Moderators)</h1>

    <?php if ($result->num_rows > 0) { ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($product = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td><img src="<?php echo $product['image']; // Assuming an image field exists ?>" alt="<?php echo $product['name']; ?>"></td>
            <td><?php echo $product['description']; ?></td>
            <td>
              <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
              <a href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>No products found!</p>
    <?php } ?>

    <p>**Moderator Actions** (additional functionalities based on your requirements):</p>
    <ul>
      <li>Approve/Reject new product submissions (if applicable)</li>
      <li>Edit product information (already implemented)</li>
      <li>Delete products</li>
      <li>Add new product categories (optional, if category table exists)</li>
      </ul>

</body>
</html>

