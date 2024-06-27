<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style-products.css">
    <?php include 'navigation-bar.php'; ?>
    <?php include('../config/dbcon.php'); // Include Firebase configuration ?>
</head>
<body>
    <div class="header">
    </div>
    <div class="container">
        <?php
        // Fetch products from Firebase
        $productsRef = $database->getReference('products');
        $products = $productsRef->getValue();

        // Loop through each product and display it if valid
        foreach ($products as $id => $product) {
            if (isset($product['title'], $product['description'], $product['price'], $product['quantity'], $product['image'])) {
                echo '<div class="product-detail">';
                echo '    <div class="product-image">';
                echo '        <a href="product_detail.php?id=' . $id . '">';
                echo '            <img src="' . $product['image'] . '" alt="Product Image">';
                echo '        </a>';
                echo '    </div>';
                echo '    <div class="product-info">';
                echo '        <h2>' . $product['title'] . '</h2>';
                echo '        <p>' . $product['description'] . '</p>';
                echo '        <p>Price: $' . $product['price'] . '</p>';
                echo '        <p>Quantity: ' . $product['quantity'] . '</p>';
                echo '        <form action="add_to_cart.php" method="post">';
                echo '            <input type="hidden" name="product_id" value="' . $id . '">';
                echo '            <label for="quantity' . $id . '">Quantity:</label>';
                echo '            <input type="number" id="quantity' . $id . '" name="quantity" value="1" min="1" max="' . $product['quantity'] . '">';
                echo '            <button type="submit">Add to Cart</button>';
                echo '        </form>';
                echo '    </div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <p id="modalDescription"></p>
        </div>
    </div>

    <script>
        function openModal(name, description) {
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('myModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function order() {
            alert('Order button clicked! Implement your order functionality here.');
        }
    </script>
</body>
</html>
