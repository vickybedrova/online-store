<?php
include('../config/dbcon.php');

// Fetch products from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'navigation-bar.php'; ?>

</head>
<body>
    <div class="header">
        <h1>Products</h1>
        <h2>About Our Products</h2>
    </div>
    <div class="container">
        <!--products to be here-->
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
