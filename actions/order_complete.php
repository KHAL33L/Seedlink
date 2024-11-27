<?php
// File: actions/order_complete.php
session_start();
require_once '../config/database.php';

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(['success' => false, 'message' => 'Please log in first']);
//     exit();
// }

$user_id = $_SESSION['user_id'];

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$cart_items = $data['items'] ?? [];

if (empty($cart_items)) {
    echo json_encode(['success' => false, 'message' => 'No items in cart']);
    exit();
}

try {
    // Start a database transaction
    $pdo->beginTransaction();

    // Calculate total price
    $total_price = 0;
    foreach ($cart_items as $item) {
        $product_stmt = $pdo->prepare("SELECT price FROM products WHERE product_id = ?");
        $product_stmt->execute([$item['product_id']]);
        $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new Exception("Product not found: " . $item['product_id']);
        }

        $total_price += $product['price'] * $item['quantity'];
    }

    // Create an order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
    $stmt->execute([$user_id, $total_price]);
    $order_id = $pdo->lastInsertId();

    // Insert order items
    $order_item_stmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price) 
        VALUES (?, ?, ?, ?)
    ");

    foreach ($cart_items as $item) {
        $product_stmt->execute([$item['product_id']]);
        $product = $product_stmt->fetch(PDO::FETCH_ASSOC);

        $order_item_stmt->execute([
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $product['price']
        ]);
    }

    // Clear cart from database
    $clear_cart_stmt = $pdo->prepare("DELETE FROM carts WHERE user_id = ?");
    $clear_cart_stmt->execute([$user_id]);

    // Commit the transaction
    $pdo->commit();

    // Send success response to clear the cart on the frontend
    echo json_encode(['success' => true, 'message' => 'Order completed successfully']);
} catch (Exception $e) {
    // Rollback the transaction on error
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Order failed: ' . $e->getMessage()]);
}
