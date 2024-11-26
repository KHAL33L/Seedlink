<?php
session_start();
include "../db/db.php";

//checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized action."]);
    exit();
}

// $product_id = $_POST['product_id']; // Product ID from the request

// Get JSON input
$requestBody = file_get_contents("php://input");
$data = json_decode($requestBody, true);

// Validate the input
if (!isset($data['product_id'])) {
    echo json_encode(["error" => "Product ID not provided."]);
    exit();
}

$product_id = $data['product_id'];


try {
    $database = new Database();
    $conn = $database->getConnection();

    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ? AND seller_id = ?");
    $stmt->bind_param("ii", $product_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Product deleted successfully."]);
    } else {
        echo json_encode(["error" => "Failed to delete product."]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

error_log(print_r($data, true)); //Logging error message
?>
