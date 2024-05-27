<?php

include 'connection.php'; 

$search_term = mysqli_real_escape_string($conn, $_GET['search']); // Sanitize user input

$sql = "SELECT * FROM product WHERE name LIKE '%$search_term%' OR description LIKE '%$search_term%'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results for "<?php echo $search_term; ?>"</h1>

    <?php if ($result->num_rows > 0) { ?>
      <?php while($product = $result->fetch_assoc()) { ?>
        <div class="product-item">
          <a href="product.php?id=<?php echo $product['id']; ?>">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo number_format($product['price'], 2); ?></p>
          </a>
        </div>
      <?php } ?>
    <?php } else { ?>
      <p>No products found matching your search term.</p>
    <?php } ?>

</body>
</html>

