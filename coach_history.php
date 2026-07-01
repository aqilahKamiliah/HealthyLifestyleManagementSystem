<?php
session_start();
include 'connection.php';
include 'headerCoach.php';

/* ===============================
   1. CHECK LOGIN
================================*/
if(!isset($_SESSION['user_id']))
{
    die("<h3>Please login first.</h3>");
}

$user_id = $_SESSION['user_id'];

/* ===============================
   2. GET coach_id
================================*/
$sql = "SELECT coach_id FROM coach WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

if(!$result || mysqli_num_rows($result) == 0)
{
    die("Coach not found.");
}

$coach = mysqli_fetch_assoc($result);
$coach_id = $coach['coach_id'];


?>

<!DOCTYPE html>
<html>
<head>
    <title>Coach History</title>
    <link rel="stylesheet" href="style1.css">

    <style>
        .container {
            width: 90%;
            margin: 30px auto;
            text-align: center;
        }

        .client-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .client-card {
            width: 280px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
            cursor: pointer;
            transition: 0.3s;
        }

        .client-card:hover {
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .badge {
            display:inline-block;
            padding:5px 10px;
            border-radius:5px;
            font-size:12px;
            margin-top:10px;
        }

        .active {
            background:#d1f7d6;
            color:#1b5e20;
        }

        .completed {
            background:#e0e0e0;
            color:#333;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Coach History</h2>
<p style="color:gray;">Select a session to view client food logs</p>

<div class="client-grid">

<?php

$sql = "
SELECT
    cs.session_id,
    cs.start_date,
    cs.end_date,
    cs.status,
    c.goal,
    u.name
FROM coaching_session cs
JOIN client c ON c.client_id = cs.client_id
JOIN users u ON u.user_id = c.user_id
WHERE cs.coach_id = '$coach_id'
ORDER BY cs.start_date DESC
";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("SQL Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0)
{
    echo "<p>No coaching sessions found.</p>";
}

while($row = mysqli_fetch_assoc($result))
{
    $badgeClass = ($row['status'] == 'Active') ? 'active' : 'completed';
?>

    <a href="history_details.php?session_id=<?php echo $row['session_id']; ?>"
       style="text-decoration:none;color:black;">

        <div class="client-card">

            <h3><?php echo $row['name']; ?></h3>

            <p><b>Goal:</b> <?php echo $row['goal']; ?></p>

            <p><b>Start:</b> <?php echo $row['start_date']; ?></p>

            <p><b>End:</b> <?php echo $row['end_date']; ?></p>

            <span class="badge <?php echo $badgeClass; ?>">
                <?php echo $row['status']; ?>
            </span>

        </div>

    </a>

<?php
}
?>

</div>

</div>

</body>
</html>