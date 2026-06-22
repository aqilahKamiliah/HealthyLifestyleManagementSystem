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
   2. GET coach_id FROM USER
================================*/
$sql = "SELECT coach_id FROM coach WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("Database Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0)
{
    die("No coach record found for this user.");
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
            width: 250px;
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
    </style>
</head>

<body>

<div class="container">

<h2>Coach History</h2>
<p>Select a client to view history</p>

<div class="client-grid">

<?php
$sql = "
SELECT Client.Client_id, Users.name, Client.goal
FROM Client
JOIN Users ON Users.user_id = Client.user_id
WHERE Client.coach_id = $coach_id
";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("SQL Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0)
{
    echo "<p>No clients assigned yet.</p>";
}

while($row = mysqli_fetch_assoc($result))
{
    echo "
    <a href='history_details.php?client_id={$row['Client_id']}' style='text-decoration:none;color:black;'>
        <div class='client-card'>
            <h3>{$row['name']}</h3>
            <p>Goal: {$row['goal']}</p>
        </div>
    </a>
    ";
}
?>

</div>

</div>

</body>
</html>