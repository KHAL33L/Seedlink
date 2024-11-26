<?php
session_start();
include "db_connection.php";

// Get the logged-in user's ID from the session
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in.");
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch user details
    $userQuery = $pdo->prepare("SELECT user_id, fname, lname, email, number FROM users WHERE user_id = :user_id");
    $userQuery->execute(['user_id' => $user_id]);
    $userDetails = $userQuery->fetch(PDO::FETCH_ASSOC);

    if (!$userDetails) {
        die("User not found.");
    }

    // Fetch user's products
    $productQuery = $pdo->prepare("SELECT product_id, category, price FROM products WHERE user_id = :user_id");
    $productQuery->execute(['user_id' => $user_id]);
    $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);

    // Combine data and return as JSON
    echo json_encode([
        'user' => $userDetails,
        'products' => $products
    ]);
} catch (PDOException $e) {
    die("Error fetching profile data: " . $e->getMessage());
}
?>
