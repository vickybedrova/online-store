<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'navigation-bar.php'; ?>
</head>
<body>
    <div class="container">
       <?php

        /*$product = [
            'id' => 1,
            'image' => 'path_to_image.jpg',
            'title' => 'Product Title',
            'description' => 'Product Description',
            'price' => 19.99
        ];
        ?>*/

      /*  <div class="product-detail">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h2><?php echo $product['title']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                
                <!-- Form for adding to cart -->
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                    
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>*/
        ?>
    </div>
  </body>
</html>
