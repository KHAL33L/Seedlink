<?php
include '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $maxPrice = $_POST['maxPrice'] ?? 0;

    try {
        // Create a new Database instance and get the connection
        $database = new Database();
        $conn = $database->getConnection();

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT product_id, name, category, price, image_url FROM products WHERE price <= ?");
        $stmt->bind_param("i", $maxPrice);
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        echo json_encode($products); // Send the data as JSON
        $stmt->close(); // Close the statement
        $conn->close(); // Close the connection
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>
