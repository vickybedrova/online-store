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
    } elseif (isset($_POST['action']) && $_POST['action'] == 'place_order') {
        // Place order functionality
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $orderSuccess = true;

            foreach ($cart as $productId => $item) {
                $productRef = $database->getReference('products/' . $productId);
                $product = $productRef->getValue();

                if ($product && $item['quantity'] <= $product['quantity']) {
                    // Deduct the quantity from the product stock
                    $newQuantity = $product['quantity'] - $item['quantity'];
                    $productRef->update(['quantity' => $newQuantity]);
                } else {
                    $orderSuccess = false;
                    break;
                }
            }

            if ($orderSuccess) {
                // Clear the cart
                unset($_SESSION['cart']);
                echo 'Order placed successfully!';
            } else {
                echo 'Failed to place order due to insufficient stock.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <div class="cart">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                echo '<div class="cart-item">';
                echo '<h2>' . $item['title'] . '</h2>';
                echo '<p>Price: $' . $item['price'] . '</p>';
                echo '<p>Quantity: ' . $item['quantity'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
    </div>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <form action="cart.php" method="post">
        <input type="hidden" name="action" value="place_order">
        <button type="submit">Place Order</button>
    </form>
    <?php endif; ?>
</body>
</html>
