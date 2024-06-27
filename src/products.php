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
        <h1>Products</h1>
        <h2>About Our Products</h2>
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
                <h2>Product Title 1</h2>
                <p>Product Description 1</p>
                <p>Price: $19.99</p>
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
                <h2>Product Title 2</h2>
                <p>Product Description 2</p>
                <p>Price: $29.99</p>
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
                <h2>Product Title 3</h2>
                <p>Product Description 3</p>
                <p>Price: $39.99</p>
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
                <h2>Product Title 4</h2>
                <p>Product Description 4</p>
                <p>Price: $49.99</p>
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
                    <img src="./images/t-shirt-5.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 5</h2>
                <p>Product Description 5</p>
                <p>Price: $59.99</p>
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
                    <img src="./images/t-shirt-6.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 6</h2>
                <p>Product Description 6</p>
                <p>Price: $69.99</p>
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
                    <img src="./images/t-shirt-7.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 7</h2>
                <p>Product Description 7</p>
                <p>Price: $79.99</p>
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
                    <img src="./images/t-shirt-8.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 8</h2>
                <p>Product Description 8</p>
                <p>Price: $89.99</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="8">
                    <label for="quantity8">Quantity:</label>
                    <input type="number" id="quantity8" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 9 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=9">
                    <img src="./images/t-shirt-9.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 9</h2>
                <p>Product Description 9</p>
                <p>Price: $99.99</p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="9">
                    <label for="quantity9">Quantity:</label>
                    <input type="number" id="quantity9" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Product 10 -->
        <div class="product-detail">
            <div class="product-image">
                <a href="product_detail.php?id=10">
                    <img src="./images/t-shirt-10.jpeg" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h2>Product Title 10</h2>
                <p>Product Description 10</p>
                <p>Price: $109.99</
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="10">
                    <label for="quantity10">Quantity:</label>
                    <input type="number" id="quantity10" name="quantity" value="1" min="1" max="10">
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
            <button onclick="order()">Order</button>
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
