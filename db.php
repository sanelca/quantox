<?php 
$servername = "localhost";
$username = "quantox";
$password = "quantox22";
$feedback = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=quantox_test", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $feedback = "Connected successfully";
  } catch(PDOException $e) {
    $feedback = "Connection failed: " . $e->getMessage();
}
?>