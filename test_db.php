<?php
include 'connection.php';
$conn = mysqli_connect("localhost", "root", "", "healthy_lifestyle_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connected successfully!";
?>