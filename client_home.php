<?php 
// 1. Mulakan session dan panggil database
session_start(); 
include 'connection.php'; 

// Sekatan keselamatan: Jika belum login, tendang balik ke login page
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id']; 

// 2. PROSES SIMPAN DATA (Jika pengguna datang dari client_bio.php)
if (isset($_POST['age'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $activity_text = $_POST['activity_level'];

    $activity_level_id = 2; 
    if ($activity_text == "Not Very Active" || $activity_text == "Lightly Active") {
        $activity_level_id = 1; 
    } else if ($activity_text == "Active" || $activity_text == "Very Active") {
        $activity_level_id = 3; 
    }

    $coach_id = 1;

    $query_insert = "INSERT INTO Client (age, gender, height, weight, activity_level_id, user_id, coach_id) 
                     VALUES ('$age', '$gender', '$height', '$weight', '$activity_level_id', '$user_id', '$coach_id')";

    if (!mysqli_query($conn, $query_insert)) {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($conn) . "');</script>";
    }
}

// 3. PROSES AMBIL DATA UNTUK DASHBOARD
// Tarik data paling terkini yang dimasukkan oleh user yang tengah login
$query_select = "SELECT * FROM Client WHERE user_id = '$user_id' ORDER BY client_id DESC LIMIT 1";
$result_select = mysqli_query($conn, $query_select);

// Sediakan nilai default jika data belum ada
$bmi = "Tiada Data";
$status_bmi = "-";
$daily_calorie = 2000; // Nilai default sementara

if (mysqli_num_rows($result_select) > 0) {
    $row = mysqli_fetch_assoc($result_select);
    $weight = $row['weight'];
    $height_cm = $row['height'];
    
    // Formula Pengiraan BMI
    $height_m = $height_cm / 100; // Tukar cm kepada meter
    if ($height_m > 0) {
        $bmi_calc = $weight / ($height_m * $height_m);
        $bmi = round($bmi_calc, 1); // Bundarkan kepada 1 titik perpuluhan
        
        // Tentukan Status BMI mengikut klasifikasi kesihatan
        if ($bmi < 18.5) {
            $status_bmi = "Underweight";
        } else if ($bmi >= 18.5 && $bmi <= 24.9) {
            $status_bmi = "Normal";
        } else if ($bmi >= 25.0 && $bmi <= 29.9) {
            $status_bmi = "Overweight";
        } else {
            $status_bmi = "Obese";
        }
    }
}

include 'headerClient.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h2>Dashboard</h2>

    <p>Welcome, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Student'; ?>!</p>

    <ul>
        <li>Current BMI: <?php echo $bmi; ?> (<?php echo $status_bmi; ?>)</li>
        <li>Daily Calorie Target: <?php echo $daily_calorie; ?> kcal</li>
        <li>Calories Consumed Today: 1200 kcal</li>
    </ul>

</body>
</html>