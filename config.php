<?php
$host = "localhost";
$user = "root";
$password = ""; // Change if your MySQL has a password
$database = "jewellery_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
