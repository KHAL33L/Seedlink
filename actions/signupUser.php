<?php

require "../db/db.php";

$database = new Database();
$conn = $database->getConnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $conn->real_escape_string($_POST["fname"]);
        $lname = $conn->real_escape_string($_POST['lname']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
         // Inserting data into the database
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES(?,?,?,?)");
        if ($stmt === false) {
            die("Prepare failed: ". $conn->error);
        }
        $stmt->bind_param("ssss", $fname, $lname, $email, $hashedPassword);
    
        //Executing query
        if ($stmt->execute())  {
            // Redirecting to the login page after successful insertion
            header("Location: ../view/login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $stmt->close(); //closing query
    
    }
    }
    
    catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
    
    // Closing connection
    $conn->close();
    ?>