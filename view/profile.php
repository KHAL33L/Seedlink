<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seedlink | Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="icon" href="../assets/images/seedlink.ico" type="icon">
</head>

<body>

<?php

include "../actions/loginUser.php";
$name = $_SESSION["fname"]." ".$_SESSION["lname"];
$email = $_SESSION["email"];

?>
    <nav class="navbar">
        <div class="logo">Seedlink</div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <div class="nav-icons">
            <!-- <a href="cart.php">🛒+</a> -->
            <a href="profile.php">Profile</a>
        </div>
    </nav>

    <div class="profile-page">
        <!-- User Details Container -->
        <div class="profile-container">
            <div class="user-details">
                <h1>User Profile</h1>
                <p><strong>Name:</strong> <span id="user-name">
                    <?php echo $name?>
                </span></p>
                <p><strong>Email:
                    <?php echo $_SESSION["email"]?></strong>
                </p>
                <p><strong>Phone  Number: </strong><span>
                    <?php echo $_SESSION["number"]?>
                </span></p>
            </div>
        </div>

        <!-- Products Overview Container -->
        <div class="products-container">
            <div class="products-overview">
                <!-- <p><strong>Total Products:</strong> <span id="total-products">5</span></p> -->
                <button id="add-product-btn" class="add-product-btn">Add New Product</button>
                <a href="../actions/logoutUser.php"><button id="add-product-btn" class="add-product-btn">Log Out</button></a>
            </div>
        </div>

        <!-- Product Table -->
        <div class="products-table-container">
            <table id="productTable">
                <thead>
                    <tr>
                        <th style="width: 35%;">Product Name</th>
                        <th style="width: 25%;">Category</th>
                        <th style="width: 15%;">Price</th>
                        <th style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- More products will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Form Modal -->
    <div id="add-product-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2>Add New Product</h2>
            <form id="add-product-form" action="../actions/uploadProduct.php" method="post" enctype="multipart/form-data">
                <label for="product-image">Product Image</label>
                <input type="file" id="product-image" name="product-image" required>

                <label for="product-name">Product Name</label>
                <input type="text" id="product-name" name="product-name" required>

                <label for="product-category">Category</label>
                <select id="product-category" name="product-category">
                    <option value="seed">Seed</option>
                    <option value="sapling">Sapling</option>
                </select>

                <label for="product-description">Description</label>
                <textarea id="product-description" name="product-description" required></textarea>

                <label for="product-price">Price</label>
                <input type="number" id="product-price" name="product-price" required>

                <button type="submit" class="submit-btn">Add Product</button>
            </form>
        </div>
    </div>

        <!-- View Product Modal -->
    <div id="viewModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span id="closeViewModal" class="close">&times;</span>
            <h2 id="viewProductName"></h2>
            <img id="viewProductImage" alt="Product Image">
            <p id="viewProductDescription"></p>
            <p><strong>Category:</strong> <span id="viewProductCategory"></span></p>
            <p><strong>Price:</strong> $<span id="viewProductPrice"></span></p>
        </div>
    </div>

    <script src="../assets/js/profile.js">
    </script>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Seedlink. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="about.php">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
