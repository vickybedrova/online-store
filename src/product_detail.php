<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <link rel="stylesheet" href="style-products.css">
    <style>
        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 600px;
            margin: auto;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            max-height: 300px; /* Limit the height to 300px */
        }

        .product-info {
            text-align: center;
            padding: 20px;
        }
    </style>
    <?php include 'navigation-bar.php'; ?>
</head>
<body>
    <div class="header"></div>
    <div class="container">
        <?php
        // Get the product ID from the URL
        $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Hardcoded product information
        $products = [
            1 => [
                'name' => 'Authentic Shrek T-Shirt',
                'description' => 'Step into the swampy style of Shrek with this t-shirt that\'s more ogre than ordinary! Embrace layers like onions and the charm of a true hero. Whether you\'re rescuing princesses or just chilling in your swamp, this shirt screams "I\'m an ogre achiever!" Guaranteed to turn heads faster than Donkey can talk!',
                'price' => '$19.99',
                'quantity' => 3,
                'image' => './images/product-1.jpeg'
            ],
            2 => [
                'name' => 'Shrek Plushie',
                'description' => 'Cuddle up with everyone\'s favorite ogre! Our plushie Shrek toy brings the magic of the swamp into your arms. Soft, green, and irresistibly charming, it\'s perfect for fans of all ages who love a hug from Shrek.',
                'price' => '$29.99',
                'quantity' => 5,
                'image' => './images/product-2.avif'
            ],
            3 => [
                'name' => 'Grey Comfy Hoodie',
                'description' => 'Wrap yourself in ogre-sized comfort with our Shrek-themed hoodie. Perfect for swampy adventures or just lounging like an ogre boss. Get cozy, Shrek style!',
                'price' => '$39.99',
                'quantity' => 7,
                'image' => './images/product-3.webp'
            ],
            4 => [
                'name' => 'Shrek Bottle',
                'description' => 'Stay hydrated with a touch of Shrek whimsy! Our Shrek bottle is not just a container, but a companion on your daily adventures. Featuring Shrek\'s iconic face, it\'s a fun and practical way to show off your love for the beloved ogre.',
                'price' => '$49.99',
                'quantity' => 4,
                'image' => './images/product-4.webp'
            ],
            5 => [
                'name' => 'Black Ogre Hoodie',
                'description' => 'Embrace your inner ogre with our Shrek-inspired hoodie. Whether you\'re out chasing dragons or chilling in your swamp, stay warm and whimsical in this ogre-ific hoodie!',
                'price' => '$59.99',
                'quantity' => 6,
                'image' => './images/product-5.webp'
            ],
            6 => [
                'name' => 'Green Ogre T-Shirt',
                'description' => 'Get ogre-whelmed with this Shrek-tastic t-shirt! It\'s layers of fun and ogre charm, perfect for any swamp adventure or just chilling like a true hero. Embrace your inner ogre and let the laughs roll!',
                'price' => '$69.99',
                'quantity' => 2,
                'image' => './images/product-6.webp'
            ],
            7 => [
                'name' => 'Fiona and Shrek Limited T-Shirt',
                'description' => 'Celebrate love, laughter, and ogre-joy with our Fiona and Shrek white t-shirt. Featuring the dynamic duo in a whimsical design, this shirt is perfect for fans of the iconic fairy tale couple. Comfortable and charming, it\'s a must-have addition to any Shrek fan\'s wardrobe.',
                'price' => '$79.99',
                'quantity' => 8,
                'image' => './images/product-7.jpeg'
            ],
            8 => [
                'name' => 'Green Shrek Hoodie',
                'description' => 'Channel your inner ogre with our Shrek-themed hoodie. Whether you\'re off on a fairy tale quest or just cozying up at home, this hoodie is your go-to for comfort and Shrektacular style!',
                'price' => '$89.99',
                'quantity' => 9,
                'image' => './images/product-8.webp'
            ],
        ];

        // Display the product details if the product ID is valid
        if (array_key_exists($product_id, $products)) {
            $product = $products[$product_id];
            ?>
            <div class="product-detail">
                <div class="product-image">
                    <img src="<?php echo $product['image']; ?>" alt="Product Image">
                </div>
                <div class="product-info">
                    <h2><?php echo $product['name']; ?></h2>
                    <p><?php echo $product['description']; ?></p>
                    <p>Price: <?php echo $product['price']; ?></p>
                    <p>Quantity: <?php echo $product['quantity']; ?></p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <label for="quantity<?php echo $product_id; ?>">Quantity:</label>
                        <input type="number" id="quantity<?php echo $product_id; ?>" name="quantity" value="1" min="1" max="10">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
            <?php
        } else {
            echo '<p>Product not found.</p>';
        }
        ?>
    </div>
</body>
</html>
