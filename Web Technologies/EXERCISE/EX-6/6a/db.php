<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root123";
$dbname = "eco_friendly_tracker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
