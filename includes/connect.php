<?php
$servername = "localhost"; // or your server IP
$username = "root";
$password = "";
$database = "complaint_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
