<?php
session_start();
include('../config/dbcon.php'); // Include Firebase configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart') {
        // Add to cart functionality
        $productId = $_POST['product_id'];
        $quantity = intval($_POST['quantity']);

        // Fetch product details from Firebase
        $productRef = $database->getReference('products/' . $productId);
        $product = $productRef->getValue();

        if ($product && $quantity > 0 && $quantity <= $product['quantity']) {
            // Add to cart
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => $quantity
                ];
            }

            echo 'Product added to cart successfully!';
        } else {
            echo 'Invalid quantity or product not available!';
        }

        // Stop further execution after sending the response
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="style-products.css">
    <?php include 'navigation-bar.php'; ?>
</head>
<body>
    <div class="header"></div>
    <div class="container">
        <?php
        $productsRef = $database->getReference('products');
        $products = $productsRef->getValue();

        if ($products) {
            foreach ($products as $id => $product) {
                if (!empty($product['title'])) { // Skip empty products
                    echo '<div class="product-detail">';
                    echo '<div class="product-image">';
                    echo '<a href="product_detail.php?id=' . $id . '">';
                    echo '<img src="' . $product['image'] . '" alt="Product Image">';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="product-info">';
                    echo '<h2>' . $product['title'] . '</h2>';
                    echo '<p>' . $product['description'] . '</p>';
                    echo '<p>Price: $' . $product['price'] . '</p>';
                    echo '<p>Quantity: ' . $product['quantity'] . '</p>';
                    echo '<form id="add-to-cart-form-' . $id . '">';
                    echo '<input type="hidden" name="action" value="add_to_cart">';
                    echo '<input type="hidden" name="product_id" value="' . $id . '">';
                    echo '<label for="quantity' . $id . '">Quantity:</label>';
                    echo '<input type="number" id="quantity' . $id . '" name="quantity" value="1" min="1" max="' . $product['quantity'] . '">';
                    echo '<button type="button" onclick="addToCart(' . $id . ')">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<p>No products available.</p>';
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

        function addToCart(productId) {
            var form = document.getElementById('add-to-cart-form-' + productId);
            var formData = new FormData(form);

            fetch('products.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Show the response message
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
