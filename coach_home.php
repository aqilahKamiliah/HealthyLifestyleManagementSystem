<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];

$coachQuery = "SELECT coach_id
               FROM coach
               WHERE user_id = '$user_id'";

$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

/* Total Active Clients */
$queryClient = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_clients
     FROM coaching_session
     WHERE coach_id = '$coach_id'
     AND status = 'Active'"
);

$dataClient = mysqli_fetch_assoc($queryClient);
$totalClients = $dataClient['total_clients'];

/* Total Completed Sessions */
$queryCompleted = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_completed
     FROM coaching_session
     WHERE coach_id = '$coach_id'
     AND status = 'Completed'"
);

$dataCompleted = mysqli_fetch_assoc($queryCompleted);
$totalCompleted = $dataCompleted['total_completed'];

/* Total Coach Evaluations */
$queryEvaluation = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_evaluations
     FROM evaluation
     WHERE coach_id = '$coach_id'
     AND evaluator = 'Coach'"
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

    <div style="
        display:flex;
        justify-content:center;
        gap:30px;
        margin-bottom:40px;
        flex-wrap:wrap;
    ">

        <div style="
            width:250px;
            padding:25px;
            border:1px solid #ccc;
            border-radius:15px;
            text-align:center;
            background:white;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        ">

            <h3>Active Clients</h3>

            <h1 style="
                color:#2e7d32;
                font-size:45px;
                margin:15px 0;
            ">
                <?php echo $totalClients; ?>
            </h1>

            <p>Current Coaching Sessions</p>

        </div>

        <div style="
            width:250px;
            padding:25px;
            border:1px solid #ccc;
            border-radius:15px;
            text-align:center;
            background:white;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        ">

            <h3>Completed Sessions</h3>

            <h1 style="
                color:#2196F3;
                font-size:45px;
                margin:15px 0;
            ">
                <?php echo $totalCompleted; ?>
            </h1>

            <p>Finished Coaching Sessions</p>

        </div>

        <div style="
            width:250px;
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