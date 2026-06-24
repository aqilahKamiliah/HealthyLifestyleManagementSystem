<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['user_id'])) {
    die("Please login first.");
}

$user_id = $_SESSION['user_id'];

/* GET CLIENT ID */
$sqlClient = "SELECT Client_id FROM Client WHERE user_id = $user_id";
$resultClient = mysqli_query($conn, $sqlClient);

if(!$resultClient || mysqli_num_rows($resultClient) == 0) {
    die("Client not found.");
}

$row = mysqli_fetch_assoc($resultClient);
$client_id = $row['Client_id'];

/* GET FORM DATA */
$meal = $_POST['meal'];
$food_item = $_POST['food_item'];
$calorie = $_POST['calorie'];

/* INSERT (MATCHING YOUR TABLE) */
$sql = "INSERT INTO food_logs (food_names, calorie, meal_type, client_id, date)
        VALUES ('$food_item', '$calorie', '$meal', '$client_id', CURDATE())";

if(mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Food log saved successfully!');
        window.location='client_log.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>