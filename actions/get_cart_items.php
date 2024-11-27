<?php
// File: actions/get_cart_items.php
session_start();
require_once '../db/db.php';

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(['success' => false, 'message' => 'Please log in first']);
//     exit();
// }

$user_id = $_SESSION['user_id'];

try {
    // Fetch cart items with product details
    $stmt = $pdo->prepare("
        SELECT 
            c.cart_id, 
            c.quantity, 
            p.product_id, 
            p.name, 
            p.price, 
            p.image_url
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total
    $total_items = array_sum(array_column($cart_items, 'quantity'));
    $total_cost = array_reduce($cart_items, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    echo json_encode([
        'success' => true, 
        'cart_items' => $cart_items,
        'total_items' => $total_items,
        'total_cost' => number_format($total_cost, 2)
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}