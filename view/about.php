<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seedlink | About</title>
    <link rel="stylesheet" href="../assets/css/about.css">
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
            <!-- <a href="profile.html">Profile</a> -->
        </div>
    </nav>

    <div class="blur-container">
        <div class="about-container">
            <div class="about-content">
                <h1 class="about-title">About Seedlink</h1>
                <p class="about-description">
                    Seedlink is a pioneering platform that brings together farmers in a unified digital ecosystem. We've created a 
                    space where agricultural innovation meets community spirit, enabling farmers to both trade and learn from each other. 
                    Our marketplace specializes in seeds and saplings of all varieties, while our knowledge-sharing platform allows 
                    experienced farmers to share their expertise and discuss trending agricultural topics. By bridging the gap between 
                    traditional farming practices and modern digital solutions, we're cultivating a future where farmers can grow together 
                    and prosper as a community.
                </p>
                
                <div class="contact-form">
                    <h2>Get in Touch</h2>
                    <form id="contact-form">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="submit-button">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            console.log('Form submitted:', { email, message });
            // Reset form after submission
            this.reset();
            alert('Thank you for your message. We will get back to you soon!');
        });
    </script>
</body>
</html>