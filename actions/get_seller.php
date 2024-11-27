<?php
include '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get the product ID from the request
    $product_id = $_GET['product_id'] ?? null;

    if (!$product_id) {
        echo json_encode(['success' => false, 'message' => 'Product ID is required']);
        exit();
    }

    try {
        $database = new Database();
        $conn = $database->getConnection();

        // Query to get the seller's phone number based on the product ID
        $stmt = $conn->prepare("
            SELECT u.number
            FROM users u
            JOIN products p ON u.user_id = p.user_id
            WHERE p.product_id = ?
        ");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $seller = $result->fetch_assoc();
            echo json_encode(['success' => true, 'number' => $seller['number']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No seller found for this product']);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
