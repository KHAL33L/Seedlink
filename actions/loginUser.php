<?php

include "../db/db.php";

// Start session for user tracking
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get database connection
    $database = new Database();
    $conn = $database->getConnection();

    // Sanitize user inputs
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Do not hash here; it’s hashed in the database

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT user_id, fname, lname, password, is_seller FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['is_seller'] = $user['is_seller'];

            header("Location: ../view/home.html");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>