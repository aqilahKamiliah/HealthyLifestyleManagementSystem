<?php
session_start();
include 'connection.php';
include 'headerCoach.php';

/* =========================
   GET CLIENT ID
========================= */
if(!isset($_GET['client_id']))
{
    die("No client selected.");
}

$client_id = $_GET['client_id'];

/* =========================
   GET CLIENT INFO
========================= */
$sqlClient = "
SELECT Users.name, Client.goal
FROM Client
JOIN Users ON Users.user_id = Client.user_id
WHERE Client.Client_id = $client_id
";

$resultClient = mysqli_query($conn, $sqlClient);

if(!$resultClient || mysqli_num_rows($resultClient) == 0)
{
    die("Client not found.");
}

$client = mysqli_fetch_assoc($resultClient);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client History</title>
    <link rel="stylesheet" href="style1.css">

    <style>
        .container {
            width: 80%;
            margin: 30px auto;
        }

        .box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            background: #fff;
        }

        .title {
            margin-bottom: 20px;
        }

        .meal {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

<div class="title">
    <h2><?php echo $client['name']; ?> - History</h2>
    <p><b>Goal:</b> <?php echo $client['goal']; ?></p>
</div>

<?php
/* =========================
   GET FOOD LOGS
========================= */
$sql = "
SELECT *
FROM Food_Logs
WHERE client_id = $client_id
ORDER BY date DESC
";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("SQL Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0)
{
    echo "<p>No food logs yet for this client.</p>";
}
else
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo "
        <div class='box'>
            <div><b>Date:</b> {$row['date']}</div>
            <div class='meal'>Meal: {$row['meal_type']}</div>
            <div>Food: {$row['food_names']}</div>
            <div>Calories: {$row['calorie']} kcal</div>
        </div>
        ";
    }
}
?>

</div>

</body>
</html>