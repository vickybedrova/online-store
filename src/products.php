<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="style-products.css">
    <?php include 'navigation-bar.php'; ?>
</head>
<body>
    <div class="header">
    </div>
    <div class="container">
        <!-- Product 1 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=1">
                    <img src="./images/product-1.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Authentic Shrek <br> T-Shirt</h2>
                <p>"Step into the swampy style of Shrek with this t-shirt that's more ogre than ordinary! 
                    Embrace layers like onions and the charm of a true hero. 
                    Whether you're rescuing princesses or just chilling in your swamp, this shirt screams 'I'm an ogre achiever!' 
                    Guaranteed to turn heads faster than Donkey can talk!"</p>
                <p>Price: $19.99</p>
                <p>Quantity: 3</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="1">
                    <label for="quantity1">Quantity:</label>
                    <input type="number" id="quantity1" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=2">
                    <img src="./images/product-2.avif" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Shrek Plushie</h2>
                <p>Cuddle up with everyone's favorite ogre! Our plushie Shrek toy brings the magic of the swamp into your arms. 
                    Soft, green, and irresistibly charming, it's perfect for fans of all ages who love a hug from Shrek.</p>
                <p>Price: $29.99</p>
                <p>Quantity: 5</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="2">
                    <label for="quantity2">Quantity:</label>
                    <input type="number" id="quantity2" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=3">
                    <img src="./images/product-3.webp" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Grey Comfy Hoodie</h2>
                <p>Wrap yourself in ogre-sized comfort with our Shrek-themed hoodie. 
                    Perfect for swampy adventures or just lounging like an ogre boss. Get cozy, Shrek style!</p>
                <p>Price: $39.99</p>
                <p>Quantity: 7</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="3">
                    <label for="quantity3">Quantity:</label>
                    <input type="number" id="quantity3" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 4 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=4">
                    <img src="./images/product-4.webp" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Shrek Bottle</h2>
                <p>Stay hydrated with a touch of Shrek whimsy! Our Shrek bottle is not just a container, 
                    but a companion on your daily adventures. 
                    Featuring Shrek's iconic face, it's a fun and practical way to show off your love for the beloved ogre."</p>
                <p>Price: $49.99</p>
                <p>Quantity: 4</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="4">
                    <label for="quantity4">Quantity:</label>
                    <input type="number" id="quantity4" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 5 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=5">
                    <img src="./images/product-5.webp" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Black Ogre Hoodie</h2>
                <p>Embrace your inner ogre with our Shrek-inspired hoodie. 
                    Whether you're out chasing dragons or chilling in your swamp, stay warm and whimsical in this ogre-ific hoodie!</p>
                <p>Price: $59.99</p>
                <p>Quantity: 6</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="5">
                    <label for="quantity5">Quantity:</label>
                    <input type="number" id="quantity5" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 6 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=6">
                    <img src="./images/product-6.webp" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Green Ogre T-Shirt</h2>
                <p>Get ogre-whelmed with this Shrek-tastic t-shirt! 
                    It's layers of fun and ogre charm, perfect for any swamp adventure or just chilling like a true hero. 
                    Embrace your inner ogre and let the laughs roll!</p>
                <p>Price: $69.99</p>
                <p>Quantity: 2</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="6">
                    <label for="quantity6">Quantity:</label>
                    <input type="number" id="quantity6" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 7 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=7">
                    <img src="./images/product-7.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Fiona and Shrek Limited T-Shirt</h2>
                <p>Celebrate love, laughter, and ogre-joy with our Fiona and Shrek white t-shirt. Featuring the dynamic duo in a whimsical design, 
                    this shirt is perfect for fans of the iconic fairy tale couple. Comfortable and charming, it's a must-have addition to any Shrek fan's wardrobe.</p>
                <p>Price: $79.99</p>
                <p>Quantity: 8</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="7">
                    <label for="quantity7">Quantity:</label>
                    <input type="number" id="quantity7" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 8 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=8">
                    <img src="./images/product-8.webp" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Green Shrek Hoodie</h2>
                <p>Channel your inner ogre with our Shrek-themed hoodie. 
                    Whether you're off on a fairy tale quest or just cozying up at home, 
                    this hoodie is your go-to for comfort and Shrektacular style!</p>
                <p>Price: $89.99</p>
                <p>Quantity: 9</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="8">
                    <label for="quantity8">Quantity:</label>
                    <input type="number" id="quantity8" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>
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
