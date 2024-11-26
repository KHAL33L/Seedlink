<?php
class Database {
    private $host = "localhost";
    private $db_name = "webtech_fall2024_ibrahim_dasuki";
    private $username = "ibrahim.dasuki";
    private $password = "Delorean12!";
    private $charset = "utf8mb4";

    function getDatabaseConnection() {
        // Set up the DSN (Data Source Name)
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
    
        try {
            // Create the PDO instance and set error mode to exception
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo; // Return the PDO instance
        } catch (PDOException $e) {
            // Catch connection errors
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
?>