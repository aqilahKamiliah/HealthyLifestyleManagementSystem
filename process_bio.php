<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan session wujud
    if (!isset($_SESSION['user_id'])) {
        die("User tidak login.");
    }

    $user_id = $_SESSION['user_id'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $coach_id = $_POST['coach_id']; 
    $activity_id = $_POST['activity_level']; 
    $goal = $_POST['goal'];

    $sql = "INSERT INTO client
(user_id, age, gender, weight, height,
activity_level_id, coach_id, goal)

VALUES

('$user_id','$age','$gender','$weight',
'$height','$activity_id','$coach_id','$goal')

ON DUPLICATE KEY UPDATE

age='$age',
gender='$gender',
weight='$weight',
height='$height',
activity_level_id='$activity_id',
coach_id='$coach_id',
goal='$goal'";

    if (mysqli_query($conn, $sql)) {
        header("Location: client_profile.php");
        exit();
    } else {
        die("Error: " . mysqli_error($conn)); 
    }
}
?>