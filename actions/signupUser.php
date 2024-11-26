<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    include '../db/db.php';

    $database = new Database();
    $pdo = $database->getDatabaseConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user inputs
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $stmt = $pdo->prepare("INSERT INTO users (fname, lname, email, password) VALUES (:fname, :lname, :email, :password)");

        // Bind parameters to the placeholders
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the login page after successful insertion
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>