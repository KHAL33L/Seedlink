
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seedlink | Home</title>
    <link rel="stylesheet" href="../assets/css/home.css">
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
            <a href="#cart">🛒+</a>
            <?php if ($isLoggedIn): ?>
                    <a href="profile.php">Profile</a>
                    <a href="../actions/logoutUser.php">Logout</a>
            <?php else: ?>
                <a href="login.html">Login</a>
            <?php endif; ?>
            </ul>
            <!-- <a href="profile.html">Profile</a> -->
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="image">
        <div class="image-left">
            <img src="../assets/images/back1.png" alt="Image failed to load" />
        </div>
        <div class="page-right">
            <p>Connecting Farmers Through Innovation and Unity</p>
           <span> <h1>Grow <br> Together</h1></span>
            <button class="explore-btn">See More</button>
        </div>
    </section>
        <section class="seed-gallery">
            <h1>OUR OFFERINGS</h1>
            <div class="seed-images">
                <div class="seed-item">
                    <img src="../assets/images/saplin1.jpeg" alt="Seed 1">
                    <p>Cherry blossom sapling</p>
                    <p class="price">$20.99</p> <!-- Price for Seed 1 -->
                </div>
                <div class="seed-item">
                    <img src="../assets/images/saplin2.jpeg" alt="Seed 2">
                    <p>Apple tree sapling</p>
                    <p class="price">$12.99</p> <!-- Price for Seed 2 -->
                </div>
                <div class="seed-item">
                    <img src="../assets/images/sapling3.jpeg" alt="Seed 3">
                    <p>Lemon tree sapling</p>
                    <p class="price">$25.99</p> <!-- Price for Seed 3 -->
                </div>
                <div class="seed-item">
                    <img src="../assets/images/sapling5.jpeg" alt="Seed 4">
                    <p>Mango seeds</p>
                    <p class="price">$15.49</p> <!-- Price for Seed 4 -->
                </div>
            </div>
        </section>
        

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
