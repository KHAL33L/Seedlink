<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../db/db.php';

try {
    $database = new Database();
    $conn = $database->getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user inputs
        $fname = $conn->real_escape_string($_POST["fname"]);
        $lname = $conn->real_escape_string($_POST["lname"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $number = $conn->real_escape_string($_POST["number"]);
        $password = $_POST["password"]; // Password will be hashed, no need to escape

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password, number) VALUES (?, ?, ?, ?,?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters to the placeholders
        $stmt->bind_param("sssss", $fname, $lname, $email, $hashedPassword, $number);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the login page after successful insertion
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Error: Could not execute the query. " . $stmt->error;
        }

        $stmt->close(); // Close the statement
    }
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}
?>
