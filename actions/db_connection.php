<?php 
// Database connection details
$host = 'localhost';
$db = 'webtech_fall2024_reindorf_naarh';
$user = 'ibrahim.dasuki'; 
$pass = 'Delorean12!';    
$charset = 'utf8mb4';

// Set up the DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Create the PDO instance and set error mode to exception
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Catch connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>