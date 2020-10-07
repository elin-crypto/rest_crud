<?php 

class Database {
    //database settings
    private $host = 'localhost;8080';
    private $db_name = 'elin_cv';
    private $username = 'elin_cv';
    private $password = 'elin_cv';
    private $conn;
    
    //connect to database
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //error with connection
        } catch(PDOException $e) { 
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }






}