<?php

include "../db/db.php";

// Start session for user tracking
session_start();

try {
    // Get database connection
    $database = new Database();
    $conn = $database->getDatabaseConnection();

    // Sanitize user inputs
    $email = $conn->$_POST['email'];
    $password = $_POST['password']; // Do not hash here; it’s hashed in the database

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT user_id, fname, lname, password, is_seller FROM users WHERE email = ?");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch results
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['email'] = $user['email'];

            header("Location: ../view/shop.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>