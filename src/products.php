<?php
session_start();
include('../config/dbcon.php'); // Include Firebase configuration

if (isset($_SESSION['user_id'])) {
    $idToken = $_SESSION['user_id'];
} else {
    echo "Firebase ID token not found in session.";
    exit();
}

try {
    // Retrieve user's custom claims
    $userRecord = $auth->getUser($idToken);
    $customClaims = $userRecord->customClaims;

    // Check if user is admin
    $isAdmin = isset($customClaims['admin']) && $customClaims['admin'];
} catch (\Exception $e) {
    // Handle errors
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Handle form submission to add a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product' && $isAdmin) {
    // Validate and sanitize form inputs
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    // Upload image file
    $targetDir = "./images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        exit();
    }

    // Allow certain file formats
    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit();
    }

    // Move uploaded file to target directory
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }

    // Insert new product into Firebase Realtime Database
    $newProductRef = $database->getReference('products')->push();
    $newProductRef->set([
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'image' => $targetFile,
        'quantity' => $quantity
    ]);

    // Redirect to products.php or display success message
    header('Location: products.php');
    exit();
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

        <!-- Display add product form for admins -->
        <?php if ($isAdmin) : ?>
            <h2>Add New Product</h2>
            <form action="products.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_product">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br><br>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <button type="submit">Add Product</button>
            </form>
        <?php endif; ?>

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
