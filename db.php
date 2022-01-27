<?php 
class Connection {
    public $servername = "localhost";
    public $username = "quantox";
    public $password = "quantox22";
    public $database = "quantox_test";
    
    function db_connection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

}



?>