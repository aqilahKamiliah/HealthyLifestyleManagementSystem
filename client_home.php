<?php 
session_start(); 
include 'connection.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"
SELECT Client_id
FROM Client
WHERE user_id='$user_id'
");

$row = mysqli_fetch_assoc($result);

$client_id = $row['Client_id'];


// Weekly weight check
$sqlWeight = "SELECT date
              FROM progress
              WHERE client_id = '$client_id'
              ORDER BY date DESC
              LIMIT 1";

$resultWeight = mysqli_query($conn, $sqlWeight);
$rowWeight = mysqli_fetch_assoc($resultWeight);

$show_modal = false;

if (!$rowWeight) {
    // Never updated weight before
    $show_modal = true;
} else {

    $last_date = strtotime($rowWeight['date']);
    $today = strtotime(date("Y-m-d"));

    $days = floor(($today - $last_date) / 86400);

    if ($days >= 7) {
        $show_modal = true;
    }
}

// ---------------- Calories Section ----------------
$sqlCalories = "
SELECT SUM(calorie) AS total_calories
FROM food_logs
WHERE client_id = '$client_id'
AND date = CURDATE()
";
$resultCalories = mysqli_query($conn, $sqlCalories);
$rowCalories = mysqli_fetch_assoc($resultCalories);
$currentIntake = $rowCalories['total_calories'] ?? 0;

$sqlGoal = "SELECT goal FROM client WHERE Client_id = '$client_id'";
$resultGoal = mysqli_query($conn, $sqlGoal);
$rowGoal = mysqli_fetch_assoc($resultGoal);
$userGoal = $rowGoal['goal'] ?? 'Maintain Weight';

if($userGoal == 'Lose Weight') {
    $goalCalories = 1800;
} elseif($userGoal == 'Gain Weight') {
    $goalCalories = 2500;
} else {
    $goalCalories = 2100;
}

$percentage = 0;
if($goalCalories > 0) {
    $percentage = round(($currentIntake / $goalCalories) * 100);
}
if($percentage > 100) { $percentage = 100; }
$remaining = $goalCalories - $currentIntake;
if($remaining < 0) { $remaining = 0; }

include 'headerClient.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Client Dashboard</title>
<link rel="stylesheet" type="text/css" href="style1.css"> 
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fafafa;
    margin: 0;
    padding: 0;
    color: #333;
}

.dashboard-container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 0 20px;
}

.dashboard-grid {
    display: table;
    width: 100%;
    table-layout: fixed;
    border-spacing: 20px 0;
    margin-top: 20px;
}

.dashboard-col {
    display: table-cell;
    vertical-align: top;
    background-color: #e8f5e9; 
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.card-title {
    font-size: 22px;
    font-weight: bold;
    color: #1b5e20; 
    margin-top: 0;
    margin-bottom: 20px;
    text-align: center;
}

.progress-box {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 0 auto 25px auto;
    border-radius: 50%;
}

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 100%;
}

.progress-text .percentage {
    font-size: 32px;
    font-weight: bold;
    color: #111;
    display: block;
}

.progress-text .stats {
    font-size: 14px;
    color: #444;
    font-weight: 500;
    display: block;
    text-align: center;
}

.stat-badges {
    text-align: center;
}

.badge {
    display: inline-block;
    width: 28%;
    margin: 0 2px;
    padding: 8px 4px;
    border-radius: 6px;
    color: white;
    font-size: 11px;
    font-weight: bold;
    text-align: center;
}

.badge-current { background-color: #4caf50; } 
.badge-goal { background-color: #2e7d32; }   
.badge-remaining { background-color: #81c784; } 

.badge span {
    display: block;
    font-size: 10px;
    font-weight: normal;
    margin-bottom: 4px;
    opacity: 0.9;
}

.log-item {
    background-color: #ffffff;
    border-radius: 20px;
    padding: 10px 15px;
    margin-bottom: 12px;
    border: 1px solid #c8e6c9;
}

.log-icon {
    display: inline-block;
    width: 30px;
    font-size: 20px;
    vertical-align: middle;
}

.log-details {
    display: inline-block;
    width: calc(100% - 40px);
    vertical-align: middle;
    font-size: 13px;
}

.log-details b { color: #222; }

.log-details span {
    color: #666;
    float: right;
    font-size: 12px;
    margin-top: 2px;
}

.btn-log-meal {
    display: block;
    width: 80%;
    margin: 20px auto;
    background-color: #4caf50;
    color: white;
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    font-size: 13px;
    text-decoration: none;
}
.btn-log-meal:hover {
    background-color: #388e3c;
}

.todo-section {
    border-top: 1px solid #c8e6c9;
    padding-top: 15px;
    margin-top: 15px;
}

.todo-section h4 {
    margin: 0 0 10px 0;
    font-size: 15px;
    color: #2e7d32;
}

.section-sub-title {
    font-size: 14px;
    font-weight: bold;
    color: #2e7d32;
    margin: 15px 0 8px 0;
}

.exercise-card {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 10px;
    border: 1px solid #c8e6c9;
}

.exercise-card .ex-title {
    font-size: 13px;
    font-weight: bold;
    color: #111;
    margin-bottom: 2px;
}

.exercise-card .ex-desc {
    font-size: 11px;
    color: #666;
}

/* --- Popup Modal Styles --- */
.modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}
.modal-box {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    width: 400px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}
.modal-box h3 { margin-bottom: 20px; color: #333; }
.modal-box input {
    width: 80%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.submit-btn {
    background: #50B848;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}
.skip-btn {
    background: #ccc;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

</style>
</head>
<body>

<!-- Weekly Weight Modal -->
<div class="modal-overlay" id="weightModal">
  <div class="modal-box">
    <h3>Update Your Weekly Weight</h3>
    <form method="POST" action="addWeight.php">
      <input type="number" step="0.1" name="weight" placeholder="Enter your weight (kg)" required>
      <br>
      <button type="submit" class="submit-btn">Submit</button>
      <button type="button" class="skip-btn" onclick="skipModal()">
    Skip for now
</button>
    </form>
  </div>
</div>

<script>
<?php if($show_modal){ ?>
document.getElementById("weightModal").style.display = "flex";
<?php } ?>

function skipModal()
{
    document.getElementById("weightModal").style.display = "none";
}
</script>

<!-- ---------------- Dashboard Content ---------------- -->
<div class="dashboard-container">
    <div class="dashboard-grid">

        <!-- Calories Card -->
        <div class="dashboard-col">
            <h3 class="card-title">Daily Calories Consumed</h3>
            <div class="progress-box"
                style="background:
                radial-gradient(circle, #e8f5e9 60%, transparent 61%),
                conic-gradient(#4caf50 0% <?= $percentage; ?>%, #c8e6c9 <?= $percentage; ?>% 100%);">
                <div class="progress-text">
                    <span class="percentage"><?= $percentage; ?>%</span>
                    <span class="stats"><?= $currentIntake; ?> / <?= $goalCalories; ?><br>kcal</span>
                </div>
            </div>
            <div class="stat-badges">
                <div class="badge badge-current"><span>Current Intake:</span><?= $currentIntake; ?> kcal</div>
                <div class="badge badge-goal"><span>Goal:</span><?= $goalCalories; ?> kcal</div>
                <div class="badge badge-remaining"><span>Remaining:</span><?= $remaining; ?> kcal</div>
            </div>
        </div>

        <!-- Food & Exercise Logs -->
        <div class="dashboard-col">
            <h3 class="card-title" style="text-align: left;">Today's Activity & Log</h3>
            <span style="font-size: 13px; font-weight: bold; color: #555; display:block; margin-bottom: 10px;">Today</span>
            <?php
            $sqlFood = "SELECT food_names, calorie, meal_type FROM food_logs WHERE client_id = '$client_id' AND date = CURDATE() ORDER BY log_id DESC";
            $foodResult = mysqli_query($conn, $sqlFood);
            if(mysqli_num_rows($foodResult) > 0) {
                while($food = mysqli_fetch_assoc($foodResult)) {
                    echo "<div class='log-item'><div class='log-icon'>🍽️</div><div class='log-details'><b>{$food['meal_type']}: {$food['food_names']}</b><span>({$food['calorie']} kcal)</span></div></div>";
                }
            } else { echo "<p>No food logged today.</p>"; }
            ?>
            <a href="client_log.php" class="btn-log-meal">+ LOG A NEW MEAL</a>
            <div class="todo-section">
                <h4>Exercise Log</h4>
                <?php
                $sqlExercise = "SELECT activity, duration, intensity FROM exercise_logs WHERE client_id = '$client_id' AND date = CURDATE() ORDER BY log_id DESC LIMIT 3";
                $exerciseResult = mysqli_query($conn, $sqlExercise);
                if(mysqli_num_rows($exerciseResult) > 0) {
                    while($ex = mysqli_fetch_assoc($exerciseResult)) {
                        echo "<div class='log-item'><div class='log-icon'>🏃</div><div class='log-details'><b>{$ex['activity']}</b><span>{$ex['duration']} min, {$ex['intensity']}</span></div></div>";
                    }
                } else { echo "<p>No exercise logged today.</p>"; }
                ?>
                <a href="client_log.php" class="btn-log-meal">+ LOG A NEW EXERCISE</a>
            </div>
        </div>

        <!-- Recommender -->
        <div class="dashboard-col">
            <h3 class="card-title" style="text-align: left; font-size: 18px;">Fitness & Exercise Recommender</h3>
            <div class="section-sub-title">Today's Workout</div>
            <?php
            $todayExercise = "SELECT activity, duration, intensity FROM exercise_logs WHERE client_id = '$client_id' AND date = CURDATE() ORDER BY log_id DESC LIMIT 3";
                        $todayResult = mysqli_query($conn, $todayExercise);
            if(mysqli_num_rows($todayResult) > 0) {
                while($today = mysqli_fetch_assoc($todayResult)) {
                    echo "<div class='exercise-card'>
                            <div class='ex-title'>🏃 {$today['activity']}</div>
                            <div class='ex-desc'>{$today['duration']} min, {$today['intensity']} intensity</div>
                          </div>";
                }
            } else {
                echo "<p>No workout logged today.</p>";
            }
            ?>

            <div class="section-sub-title">Suggested Activity</div>
            <?php
            $suggestWorkout = "
            SELECT exercise.exercise_name, exercise.sets
            FROM client
            JOIN exercise 
            ON client.activity_level_id = exercise.activity_level_id
            WHERE client.Client_id = '$client_id'
            LIMIT 1
            ";
            $suggestResult = mysqli_query($conn, $suggestWorkout);
            if(mysqli_num_rows($suggestResult) > 0) {
                $suggest = mysqli_fetch_assoc($suggestResult);
                echo "<div class='exercise-card'>
                        <div class='ex-title'>💡 {$suggest['exercise_name']}</div>
                        <div class='ex-desc'>{$suggest['sets']}</div>
                      </div>";
            } else {
                echo "<p>No suggested activity available.</p>";
            }
            ?>

            <div class="section-sub-title">Previous Exercise</div>
            <?php
            $previousExercise = "
            SELECT activity, duration, intensity, date
            FROM exercise_logs
            WHERE client_id = '$client_id'
            AND date < CURDATE()
            ORDER BY date DESC, log_id DESC
            LIMIT 1
            ";
            $previousResult = mysqli_query($conn, $previousExercise);
            if(mysqli_num_rows($previousResult) > 0) {
                $prev = mysqli_fetch_assoc($previousResult);
                echo "<div class='exercise-card'>
                        <div class='ex-title'>🕒 {$prev['activity']}</div>
                        <div class='ex-desc'>{$prev['date']} — {$prev['duration']} min, {$prev['intensity']}</div>
                      </div>";
            } else {
                echo "<p>No previous exercise yet.</p>";
            }
            ?>
        </div> <!-- end of recommender column -->

    </div> <!-- end of dashboard-grid -->
</div> <!-- end of dashboard-container -->

</body>
</html>
