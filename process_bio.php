<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan user_id diambil dari session, BUKAN letak manual '2'
    $user_id = $_SESSION['user_id']; 
    
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity = $_POST['activity_level'];

    // Simpan ke dalam database
    $query = "INSERT INTO Client (user_id, age, gender, height, weight, activity_level) 
              VALUES ('$user_id', '$age', '$gender', '$height', '$weight', '$activity')";

    if (mysqli_query($conn, $query)) {
        // Berjaya, bawa ke profil
        header("Location: client_profile.php");
        exit();
    } else {
        echo "Ralat: " . mysqli_error($conn);
    }
}
?>