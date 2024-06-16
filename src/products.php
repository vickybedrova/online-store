<?php

include 'connection.php'; 

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <?php if ($result->num_rows > 0) { ?>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($product = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $product['name']; ?></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td><img src="<?php echo $product['image']; // Assuming an image field exists ?>" alt="<?php echo $product['name']; ?>"></td>
            <td><?php echo $product['description']; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>No products found!</p>
    <?php } ?>

    <h2>About Our Products</h2>
    <p>Our products are carefully selected by a team of moderators with expertise in various categories. 
       This ensures a high standard of quality and variety for our customers.</p>

</body>
</html>

