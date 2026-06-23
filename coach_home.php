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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

    <div style="display:flex; justify-content:space-between;">

        <div style="border:1px solid #ccc; padding:20px; border-radius:15px; width:30%; text-align:center;">
            <h3>Total Clients</h3>
            <h1><?php echo $totalClients; ?></h1>
            <p>Active Clients</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:15px; width:30%; text-align:center;">
            <h3>Upcoming Sessions</h3>
            <h1>0</h1>
            <p>This Week</p>
        </div>

    </div>

    <div style="display:flex; justify-content:center; margin-top:30px;">

        <div style="border:1px solid #ccc; padding:20px; border-radius:15px; width:30%; text-align:center;">
            <h3>Completed Sessions</h3>
            <h1>0</h1>
            <p>This Month</p>
        </div>

    </div>

</div>

</body>
</html>