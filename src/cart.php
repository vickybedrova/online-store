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
    <link rel="stylesheet" href="style.css">
    <?php include 'navigation-bar.php'; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            margin-bottom: 10px;
        }

        .cart-item h2 {
            margin: 5px 0;
            color: black;
        }

        .cart-item p {
            margin: 5px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .empty-cart {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }

        .order-btn {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .order-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <h2><?php echo $item['title']; ?></h2>
                    <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                </div>
            <?php endforeach; ?>
            <form action="cart.php" method="post">
                <input type="hidden" name="action" value="place_order">
                <button type="submit" class="order-btn">Place Order</button>
            </form>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
