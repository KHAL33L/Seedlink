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
    <nav class="navbar">
        <div class="logo">Seedlink</div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <div class="nav-icons">
            <a href="#cart">🛒+</a>
            <a href="profile.php">Profile</a>
        </div>
    </nav>

    <div class="profile-page">
        <!-- User Details Container -->
        <div class="profile-container">
            <div class="user-details">
                <h1>User Profile</h1>
                <p><strong>Name:</strong> <span id="user-name">John Doe</span></p>
                <p><strong>Email:</strong> <span id="user-email">johndoe@example.com</span></p>
            </div>
        </div>

        <!-- Products Overview Container -->
        <div class="products-container">
            <div class="products-overview">
                <p><strong>Total Products:</strong> <span id="total-products">5</span></p>
                <button id="add-product-btn" class="add-product-btn">Add New Product</button>
                <a href="../actions/logoutUser.php"><button id="add-product-btn" class="add-product-btn">Log Out</button></a>
            </div>
        </div>

        <!-- Product Table -->
        <div class="products-table-container">
            <table id="products-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Product Name</th>
                        <th style="width: 25%;">Category</th>
                        <th style="width: 15%;">Price</th>
                        <th style="width: 25%;">Actions</th>
                    </tr>
                </thead>
                
                <tbody id="products-list">
                    <!-- Example of a product entry -->
                    <tr>
                        <td>Tomato Sapling</td>
                        <td>Sapling</td>
                        <td>$10</td>
                        <td>
                            <button class="view-btn" onclick="viewProduct(1)">View</button>
                            <button class="edit-btn" onclick="editProduct(1)">Edit</button>
                            <button class="delete-btn" onclick="deleteProduct(1)">Delete</button>
                        </td>
                    </tr>
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

    <script>
        // Open and close modal for adding products
        document.getElementById('add-product-btn').addEventListener('click', function() {
            document.getElementById('add-product-modal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('add-product-modal').style.display = 'none';
        }

        // Handle form submission for adding products
        // document.getElementById('add-product-form').addEventListener('submit', function(event) {
        //     event.preventDefault();
        //     // Normally here you'd send the form data to the server via AJAX (or PHP).
        //     alert('Product added successfully!');
        //     closeModal();
        //     // Optionally, update the products table dynamically here.
        // });

        // Function to view product details
        function viewProduct(productId) {
            alert('Viewing details for product ID: ' + productId);
        }

        // Function to edit product details
        function editProduct(productId) {
            alert('Editing product ID: ' + productId);
        }

        // Function to delete product
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                alert('Product ID ' + productId + ' deleted.');
                // You would also remove the product from the table or update the database here.
            }
        }
    </script>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Seedlink. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
