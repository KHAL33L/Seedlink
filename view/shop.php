<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeedLink | Shop</title>
    <link rel="stylesheet" href="../assets/css/shop.css">
    <link rel="icon" href="../assets/images/seedlink.ico" type="icon">
</head>
<body>

<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Replace 'user_id' with your session key
?>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">Seedlink</div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <div class="nav-icons">
            <ul>
            <!-- <a href="cart.php">🛒+</a> -->
            <?php if ($isLoggedIn): ?>
                    <a href="profile.php">Profile</a>
                    <a href="../actions/logoutUser.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">

            <button id="seeds-btn" class="left-btn">Seeds</button>
            <button id="saplings-btn" class="left-btn">Saplings</button>
            <br>
            <br>
            <h2>Filter By</h2>
            <input type="range" id="filter-slider" min="0" max="1000" value="300" step="5">
            <p>Price GH₵: <span id="sliderValue">50</span></p>
            
        </div>

        <!-- Right Panel -->
        <div class="right-panel">

           
            <!-- Seeds Card -->
             <div id="seeds-card" class="product-right active">
                <h1>Seed Products</h1>
                <div class="product-grid" id="productGrid">
                    <!-- Products will be dynamically loaded here -->
                </div>
            </div>

            

            <!-- Saplings Card -->

            <div id="saplings-card" class="product-right">
                <h1>Sapling Products</h1>
                <div class="product-grid" id="productGridSaplings">
                    <!-- Saplings will be dynamically loaded here -->
                </div>
            </div>


            <!-- Product Details Modal --> 
            <div id="productModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span id="closeModal" class="close">&times;</span>
                    <img id="modalProductImage" alt="Product Image">
                    <h2 id="modalProductName"></h2>
                    <p id="modalProductDescription"></p>
                    <p><strong>Price:</strong> $<span id="modalProductPrice"></span></p>
                    <p><strong>Seller's Phone:</strong> <span id="sellerPhone">Loading...</span></p>

                    
                    <!-- <label for="productQuantity">Quantity:</label>
                    <input type="number" id="productQuantity" min="1" value="1">
                    <button id="modalAddToCart">Add to Cart</button> -->
                </div>
             </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>SeedLink &copy; 2024 | Contact us: support@seedlink.com</p>
    </footer>

    <script src="../assets/js/shop.js"></script>
    <script src="../assets/js/shop_sapling.js"></script>
    <script src="../assets/js/add_to_cart.js"></script>
</body>
</html>
