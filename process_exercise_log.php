<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sqlClient = "SELECT Client_id FROM Client WHERE user_id = '$user_id'";
$resultClient = mysqli_query($conn, $sqlClient);
$rowClient = mysqli_fetch_assoc($resultClient);
$client_id = $rowClient['Client_id'];

$activity = $_POST['activity'];
$duration = $_POST['duration'];
$intensity = $_POST['intensity'];

$sql = "INSERT INTO exercise_logs
        (client_id, activity, duration, intensity, date)
        VALUES
        ('$client_id', '$activity', '$duration', '$intensity', CURDATE())";

if(mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Exercise log saved successfully!');
        window.location='client_home.php';
    </script>";
} else {
    echo mysqli_error($conn);
}
?>