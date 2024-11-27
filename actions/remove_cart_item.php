<?php
// File: actions/remove_cart_item.php
session_start();
require_once '../db/db.php';

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(['success' => false, 'message' => 'Please log in first']);
//     exit();
// }

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$cart_id = $data['cart_id'];
$user_id = $_SESSION['user_id'];

try {
    // Delete specific cart item for the user
    $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}