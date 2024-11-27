<?php
session_start();
include "../db/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to add a product.";
        exit();
    }

    $seller_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $name = $_POST['product-name'];
    $category = $_POST['product-category'];
    $description = $_POST['product-description'];
    $price = $_POST['product-price'];

    // File upload handling
    $targetDir = "../uploads/products/";
    $fileName = basename($_FILES["product-image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate file type
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }

    // Move file to the target directory
    if (!move_uploaded_file($_FILES["product-image"]["tmp_name"], $targetFilePath)) {
        echo "Failed to upload the image.";
        exit();
    }

    // Save product data to the database
    try {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare("INSERT INTO products (seller_id, name, category, description, price, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssds", $seller_id, $name, $category, $description, $price, $targetFilePath);

        if ($stmt->execute()) {
            echo "Product added successfully!";
            header("Location: ../view/profile.php"); // Redirect to marketplace or another page
            exit();
        } else {
            echo "Failed to add product: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
