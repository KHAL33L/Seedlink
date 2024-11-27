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

// // Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// // If not logged in, redirect to login page
// if (!$isLoggedIn) {
//     header("Location: login.php");
//     exit();
// }
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
                    <!-- Cart items will be dynamically loaded here -->
                </tbody>
            </table>
        </div>

        <!-- Cart Summary -->
        <div class="products-container">
            <h2>Cart Summary</h2>
            <p>Total Items: <span id="totalItems">0</span></p>
            <p>Total Cost: $<span id="totalCost">0.00</span></p>
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

    <!-- JavaScript for Cart Management -->
    <script>
        // Fetch cart items when page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchCartItems();
        });

        function fetchCartItems() {
            fetch('../actions/get_cart_items.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartTableBody = document.getElementById('cartTableBody');
                    cartTableBody.innerHTML = ''; // Clear existing rows

                    data.cart_items.forEach((item, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.name}</td>
                                <td>$${parseFloat(item.price).toFixed(2)}</td>
                                <td>${item.quantity}</td>
                                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                                <td>N/A</td>
                                <td>
                                    <button class="remove-btn" onclick="removeCartItem(${item.cart_id})">Remove</button>
                                </td>
                            </tr>
                        `;
                        cartTableBody.innerHTML += row;
                    });

                    // Update summary
                    document.getElementById('totalItems').textContent = data.total_items;
                    document.getElementById('totalCost').textContent = data.total_cost;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load cart items');
            });
        }

        function removeCartItem(cartId) {
            fetch('../actions/remove_cart_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cart_id: cartId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    fetchCartItems(); // Reload cart items
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to remove item from cart');
            });
        }

        function completeOrder() {
            // Fetch cart items to prepare for order
            fetch('../actions/get_cart_items.php')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.cart_items.length > 0) {
                    const cartItems = data.cart_items.map(item => ({
                        product_id: item.product_id,
                        quantity: item.quantity
                    }));

                    // Send order to backend
                    return fetch('../actions/order_complete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ items: cartItems })
                    });
                } else {
                    throw new Error('Cart is empty');
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order completed successfully!');
                    fetchCartItems(); // Reload to show empty cart
                } else {
                    alert('Failed to complete order: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while completing the order');
            });
        }
    </script>
</body>
</html>