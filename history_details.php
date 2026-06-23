<?php
session_start();
include 'connection.php';
include 'headerCoach.php';

if(!isset($_GET['client_id'])) {
    die("No client selected.");
}

$client_id = $_GET['client_id'];

/* CLIENT INFO */
$sqlClient = "
SELECT Users.name, Client.goal
FROM Client
JOIN Users ON Users.user_id = Client.user_id
WHERE Client.Client_id = $client_id
";

$resultClient = mysqli_query($conn, $sqlClient);
$client = mysqli_fetch_assoc($resultClient);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client History</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px 0;
        }

        /* HEADER */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin-bottom: 5px;
            font-size: 28px;
        }

        .header p {
            color: #666;
        }

        /* DATE CARD */
        .date-section {
            margin-bottom: 25px;
        }

        .date-title {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        /* MEAL CARD */
        .meal-box {
            background: #fff;
            border-radius: 12px;
            padding: 15px 18px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid #4caf50;
        }

        .meal-type {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .food {
            color: #555;
            margin-bottom: 3px;
        }

        .calorie {
            color: #777;
            font-size: 14px;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2><?php echo $client['name']; ?> - Food History</h2>
        <p><b>Goal:</b> <?php echo $client['goal']; ?></p>
    </div>

<?php
$sql = "
SELECT *
FROM food_logs
WHERE client_id = $client_id
ORDER BY date DESC, meal_type
";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0) {
    echo "<p style='text-align:center;'>No food logs yet.</p>";
}
else {

    $currentDate = "";

    while($row = mysqli_fetch_assoc($result)) {

        // NEW DATE HEADER
        if($currentDate != $row['date']) {

            // close previous section (just visual separation)
            if($currentDate != "") {
                echo "</div>";
            }

            $currentDate = $row['date'];

            echo "
            <div class='date-section'>
                <div class='date-title'> {$currentDate}</div>
            ";
        }

        // MEAL CARD
        echo "
        <div class='meal-box'>
            <div class='meal-type'> {$row['meal_type']}</div>
            <div class='food'>Food: {$row['food_names']}</div>
            <div class='calorie'>Calories: {$row['calorie']} kcal</div>
        </div>
        ";
    }

    // close last section
    echo "</div>";
}
?>

</div>

</body>
</html>