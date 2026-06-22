<?php
session_start();
include 'connection.php';
include 'headerClient.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Proses simpan data apabila butang ditekan
if (isset($_POST['save_bio'])) {
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $activity_level = mysqli_real_escape_string($conn, $_POST['activity_level']);
    $coach_id = 1; // Anda boleh ubah mengikut sistem anda

    $query = "INSERT INTO Client (age, gender, height, weight, activity_level_id, user_id, coach_id) 
              VALUES ('$age', '$gender', '$height', '$weight', '$activity_level', '$user_id', '$coach_id')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Maklumat berjaya disimpan!'); window.location='client_profile.php';</script>";
        exit();
    } else {
        $message = "Ralat: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Bio</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: #e8f5e9; border-radius: 15px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #6c5ce7; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Biometric Data</h2>
    <?php if($message) echo "<p style='color:red;'>$message</p>"; ?>
    
    <form method="POST" action="clientbio.php">
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label>Height (cm)</label>
            <input type="number" name="height" required>
        </div>
        <div class="form-group">
            <label>Weight (kg)</label>
            <input type="number" step="0.1" name="weight" required>
        </div>
        <div class="form-group">
            <label>Activity Level</label>
            <select name="activity_level" required>
                <option value="1">Not Very Active</option>
                <option value="2">Lightly Active</option>
                <option value="3">Moderate</option>
                <option value="4">Active</option>
            </select>
        </div>
        <button type="submit" name="save_bio">Save Details</button>
    </form>
</div>

</body>
</html>