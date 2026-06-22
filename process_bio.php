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
    // Contoh jika mahu kemaskini rekod sedia ada (Update)
$sql = "UPDATE Client SET 
        age = '$age', 
        gender = '$gender', 
        weight = '$weight', 
        height = '$height' 
        WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
    // Jika berjaya, terus bawa ke profil
    header("Location: client_profile.php");
}
}
?>