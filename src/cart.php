<?php
include('../config/dbcon.php');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = []; // Initialize empty cart if not set
}

$cart_items = $_SESSION['cart']; // Access cart items from session

$total_price = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'navigation-bar.php'; ?>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="number"] {
            width: 50px;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <?php if (count($cart_items) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item_id => $item_data) {
                        $product_id = $item_id;
                        $quantity = $item_data['quantity'];

                        $sql = "SELECT * FROM product WHERE id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            $price = $product['price'];
                            $subtotal = $price * $quantity;
                            $total_price += $subtotal;
                        } else {
                            // Handle product not found error (remove from cart?)
                        } ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td>$<?php echo number_format($price, 2); ?></td>
                            <td><input type="number" min="1" value="<?php echo $quantity; ?>"></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td><a href="update_cart.php?id=<?php echo $product_id; ?>&action=remove">Remove</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
            <a href="checkout.php">Proceed to Checkout</a>
        <?php } else { ?>
            <p>Your cart is empty!</p>
        <?php } ?>
    </div>
</body>
</html>
