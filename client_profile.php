<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT name FROM users WHERE user_id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$display_name = $user_data['name'] ?? "User";
$client_query = "SELECT * FROM client WHERE user_id = '$user_id'";
$client_result = mysqli_query($conn, $client_query);
$data = mysqli_fetch_assoc($client_result);

$age     = $data['age'] ?? "-";
$gender  = $data['gender'] ?? "-";
$weight  = $data['weight'] ?? "0";
$height  = $data['height'] ?? "0";

$bmi = "-";
$bmi_status = "-";
if ($weight > 0 && $height > 0) {
    $bmi_val = round($weight / (($height/100) * ($height/100)), 1);
    $bmi = $bmi_val;
    if ($bmi_val < 18.5) $bmi_status = "Underweight";
    elseif ($bmi_val < 25) $bmi_status = "Normal";
    elseif ($bmi_val < 30) $bmi_status = "Overweight";
    else $bmi_status = "Obese";

    $coach_name = "No Coach Selected";
$coach_specialization = "-";

if(isset($data['coach_id']) && $data['coach_id'] != 0)
{
    $coach_id = $data['coach_id'];

    $coach_query = "SELECT users.name, coach.specialization
                    FROM coach, users
                    WHERE coach.user_id = users.user_id
                    AND coach.coach_id = '$coach_id'";

    $coach_result = mysqli_query($conn, $coach_query);
    $coach_data = mysqli_fetch_assoc($coach_result);

    $coach_name = $coach_data['name'] ?? "No Coach Selected";
    $coach_specialization = $coach_data['specialization'] ?? "-";
}
}
?>
<?php include 'headerClient.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .profile-page-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .green-card {
            background-color: #e8f5e9; 
            border-radius: 8px;
            padding: 20px 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .user-header-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-meta {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .avatar-circle {
            width: 60px;
            height: 60px;
            background-color: #c8e6c9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #2e7d32;
        }

        .user-name-title h2 {
            margin: 0;
            font-size: 28px;
            color: #111;
        }

        .user-name-title span {
            font-size: 13px;
            color: #666;
        }

        .bmi-score-box {
            text-align: right;
        }

        .bmi-score-box h3 {
            margin: 0;
            font-size: 24px;
            color: #1b5e20;
        }

        .bmi-score-box span {
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        .profile-middle-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .middle-col {
            flex: 1;
            padding: 25px;
        }

        .middle-col h3 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 24px;
            color: #1b5e20;
        }

        .snapshot-table {
            width: 100%;
            border-collapse: collapse;
        }

        .snapshot-table td {
            padding: 12px 0;
            font-size: 18px;
            color: #333;
        }

        .snapshot-table td:last-child {
            text-align: right;
            font-weight: 500;
            color: #111;
        }

        .goal-flex-container {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 15px;
        }

        .mini-progress-box {
            position: relative;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, #e8f5e9 60%, transparent 61%), 
                        conic-gradient(#4caf50 0% 65%, #c8e6c9 65% 100%); 
            border-radius: 50%;
        }

        .mini-progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
        }

        .mini-progress-text .pct {
            font-size: 22px;
            font-weight: bold;
            color: #111;
            display: block;
        }

        .mini-progress-text .sub-pct {
            font-size: 10px;
            color: #555;
        }

        .goal-details-text {
            font-size: 16px;
            color: #333;
        }

        .goal-details-text h4 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: #555;
            font-weight: normal;
        }

        .goal-details-text p {
            margin: 0 0 15px 0;
            font-size: 22px;
            font-weight: bold;
            color: #111;
        }

        .goal-details-text p span {
            font-size: 12px;
            font-weight: normal;
            color: #666;
            display: block;
        }
        .coach-footer-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .coach-meta-text {
            width: 100%;
            font-size: 16px;
        }

        .coach-meta-text b {
            font-size: 20px;
            color: #111;
        }

        .coach-meta-text .cert-tag {
            float: right;
            font-size: 16px;
            color: #444;
        }
    </style>
</head>
<body>


<div class="profile-page-container">

    <div class="green-card user-header-card">
        <div class="user-meta">
            <div class="avatar-circle">👤</div>
            <div class="user-name-title">
                <h2><?php echo htmlspecialchars($display_name); ?></h2>
                <span>Standard User</span>
            </div>
        </div> <div class="bmi-score-box">
            <h3>BMI : <?php echo $bmi; ?></h3>
            <span><?php echo $bmi_status; ?></span>
        </div>
    </div> <div class="profile-middle-grid">
        <div class="green-card middle-col">
            <h3>Biometric Snapshot</h3>
            <table class="snapshot-table">
                <tr><td>Age :</td><td><?php echo $age; ?></td></tr>
                <tr><td>Gender :</td><td><?php echo $gender; ?></td></tr>
                <tr><td>Current Weight :</td><td><?php echo $weight; ?> kg</td></tr>
                <tr><td>Height :</td><td><?php echo $height; ?> cm</td></tr>
            </table>
        </div>

        <div class="green-card middle-col">
            <h3>Daily Tracking Goal</h3>
            <div class="goal-flex-container">
                <div class="mini-progress-box">
                    <div class="mini-progress-text">
                        <span class="pct">65%</span>
                        <span class="sub-pct">1,365 / 2,100 kcal</span>
                    </div>
                </div>
                <div class="goal-details-text">
                    <h4>Target Intake :</h4>
                    <p>2100 kcal <span>( For Weight Loss )</span></p>
                    <h4>Avg. Intake :</h4>
                    <p style="margin-bottom: 0;">2000 kcal</p>
                </div>
            </div>
        </div>
    </div> <div class="green-card coach-footer-card">
        <div class="avatar-circle" style="width: 45px; height: 45px; font-size: 22px;">👤</div>
        <div class="coach-meta-text">
            <span>Your Coach :</span><br>
            <b><?php echo htmlspecialchars($coach_name); ?></b>
            <span class="cert-tag">( <?php echo htmlspecialchars($coach_specialization); ?> )</span>
        </div>
    </div>

</div>

</body>
</html>