<?php
class Database {
    private $host = "localhost";
    private $db_name = "webtech_fall2024_reindorf_narh";
    private $username = "reindorf.narh";
    private $password = "(Qw123ty_)";
    public $conn;


    public function getConnection() {
        $this->conn = null;

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
       
        

        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);
            
        }
        else{
            // echo "Connection successfull!!";
        }

        return $this->conn;
    }
}



?>


