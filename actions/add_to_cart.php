<?php
// File: actions/add_to_cart.php
session_start();
require_once '../db/db.php';

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(['success' => false, 'message' => 'Please log in first']);
//     exit();
// }

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
$quantity = $data['quantity'] ?? 1;
$user_id = $_SESSION['user_id'];

try {
    // Check if product exists
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        exit();
    }

    // Check if product is already in cart
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $existing_cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_cart_item) {
        // Update quantity if product already in cart
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$quantity, $user_id, $product_id]);
    } else {
        // Insert new cart item
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity]);
    }

    echo json_encode(['success' => true, 'message' => 'Product added to cart']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}