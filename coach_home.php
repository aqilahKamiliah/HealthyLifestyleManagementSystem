<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];

/* Ambil coach_id berdasarkan user yang login */
$coachQuery = "SELECT coach_id
               FROM coach
               WHERE user_id = '$user_id'";

$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

/* Kira jumlah client bawah coach tersebut */
$queryClient = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_clients
     FROM client
     WHERE coach_id = '$coach_id'"
);

$dataClient = mysqli_fetch_assoc($queryClient);
$totalClients = $dataClient['total_clients'];

/* Kira jumlah evaluation yang dibuat oleh coach */
$queryEvaluation = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_evaluations
     FROM evaluation
     WHERE coach_id = '$coach_id'"
);

$dataEvaluation = mysqli_fetch_assoc($queryEvaluation);
$totalEvaluations = $dataEvaluation['total_evaluations'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coach Home</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

    <!-- Dashboard Cards -->
    <div style="
        display:flex;
        justify-content:center;
        gap:40px;
        margin-bottom:40px;
        flex-wrap:wrap;
    ">

        <!-- Total Clients Card -->
        <div style="
            width:300px;
            padding:25px;
            border:1px solid #ccc;
            border-radius:15px;
            text-align:center;
            background:white;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        ">

            <h3>Total Clients</h3>

            <h1 style="
                color:#2e7d32;
                font-size:45px;
                margin:15px 0;
            ">
                <?php echo $totalClients; ?>
            </h1>

            <p>Active Clients</p>

        </div>

        <!-- Total Evaluations Card -->
        <div style="
            width:300px;
            padding:25px;
            border:1px solid #ccc;
            border-radius:15px;
            text-align:center;
            background:white;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        ">

            <h3>Total Evaluations</h3>

            <h1 style="
                color:#6a5acd;
                font-size:45px;
                margin:15px 0;
            ">
                <?php echo $totalEvaluations; ?>
            </h1>

            <p>Evaluations Submitted</p>

        </div>

    </div>

    <!-- Coach Wellness Tip -->
    <div style="
        background:white;
        border:1px solid #ccc;
        border-radius:15px;
        padding:30px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
    ">

        <h2 style="
            color:#2e7d32;
            margin-bottom:20px;
        ">
            🌱 Coach Wellness Tip
        </h2>

        <p style="
            font-size:16px;
            line-height:1.8;
            color:#555;
        ">
            Encourage clients to maintain consistent food logging habits.
            Regular meal tracking helps identify eating patterns, supports
            healthier lifestyle choices, and helps coaches provide more
            accurate recommendations for achieving health goals.
        </p>

        <hr style="margin:25px 0;">

        <h3 style="color:#2e7d32;">
            💧 Nutrition Reminder
        </h3>

        <p style="
            font-size:15px;
            line-height:1.8;
            color:#555;
        ">
            Remind clients to drink enough water throughout the day.
            Proper hydration supports digestion, improves energy levels,
            and contributes to overall health and well-being.
        </p>

    </div>

</div>

</body>
</html>