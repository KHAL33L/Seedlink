<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="../assets/css/cart.css">
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
                <a href="cart.php">🛒+</a>
                <?php if ($isLoggedIn): ?>
                    <a href="profile.php">Profile</a>
                    <a href="../actions/logoutUser.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Cart Container -->
    <div class="profile-page">
        <div class="profile-container">
            <h1>Your Cart</h1>
            <p>Review your items before completing your order.</p>
        </div>
        <div class="products-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cartTableBody">
                    <tr>
                        <td>1</td>
                        <td>Tomato Seeds</td>
                        <td>$5.00</td>
                        <td>2</td>
                        <td>$10.00</td>
                        <td>+233 24 123 4567</td>
                        <td>
                            <button class="remove-btn">Remove</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mango Sapling</td>
                        <td>$15.00</td>
                        <td>1</td>
                        <td>$15.00</td>
                        <td>+233 55 987 6543</td>
                        <td>
                            <button class="remove-btn">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Cart Summary -->
        <div class="products-container">
            <h2>Cart Summary</h2>
            <p>Total Items: 3</p>
            <p>Total Cost: $25.00</p>
            <!-- Changed "Clear Cart" to "Order Complete" -->
            <button class="submit-btn" onclick="completeOrder()">Order Complete</button>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- JavaScript for Completing the Order -->
    <script>
        function completeOrder() {
            // Example: Gather cart items and prepare data
            const cartItems = [
                { product_id: 1, seller_id: 101, order_quantity: 2 }, // Sample data
                { product_id: 2, seller_id: 102, order_quantity: 1 }
            ];

            // Placeholder: AJAX call to backend to insert order into the orders table
            fetch('../actions/order_complete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    items: cartItems // Pass the cart items to the server
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order has been completed!');
                    // Clear cart items (frontend action)
                    // For example, clear localStorage or session storage, or update the UI
                    location.reload(); // Reload to reflect the changes
                } else {
                    alert('Failed to complete the order.');
                }
            })
            .catch(error => {
                alert('Error occurred while completing the order.');
            });
        }
    </script>
</body>
</html>
