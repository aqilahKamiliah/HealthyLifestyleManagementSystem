<?php
session_start();
include 'connection.php';

if(isset($_POST['notify']))
{
    $client_id = $_POST['client_id'];
    $missing_meals = $_POST['missing_meals'];

    $message = "Reminder: Please log your " . $missing_meals . " meal(s) today.";

    $insertHistory = "INSERT INTO history(client_id, message)
                      VALUES('$client_id', '$message')";

    mysqli_query($conn, $insertHistory);

    echo "<script>
            alert('Reminder sent successfully!');
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

<?php

$user_id = $_SESSION['user_id'];

$coachQuery = "SELECT coach_id
               FROM coach
               WHERE user_id = '$user_id'";

$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

if(isset($_GET['client_id']))
{
    $client_id = $_GET['client_id'];

    $clientQuery = "SELECT users.name,
                           client.goal
                    FROM client
                    INNER JOIN users
                    ON client.user_id = users.user_id
                    WHERE client.client_id = '$client_id'";

    $clientResult = mysqli_query($conn, $clientQuery);
    $clientData = mysqli_fetch_assoc($clientResult);

    $name = $clientData['name'];
    $goal = $clientData['goal'];

    $foodQuery = "SELECT *
                  FROM food_logs
                  WHERE client_id = '$client_id'
                  AND date = CURDATE()";

    $foodResult = mysqli_query($conn, $foodQuery);

    $breakfastFood = "No Log";
    $breakfastCal = "-";

    $lunchFood = "No Log";
    $lunchCal = "-";

    $dinnerFood = "No Log";
    $dinnerCal = "-";

    while($food = mysqli_fetch_assoc($foodResult))
    {
        if($food['meal_type'] == 'Breakfast')
        {
            $breakfastFood = $food['food_names'];
            $breakfastCal = $food['calorie'];
        }

        if($food['meal_type'] == 'Lunch')
        {
            $lunchFood = $food['food_names'];
            $lunchCal = $food['calorie'];
        }

        if($food['meal_type'] == 'Dinner')
        {
            $dinnerFood = $food['food_names'];
            $dinnerCal = $food['calorie'];
        }
    }

    $missingMeals = array();

    if($breakfastFood == "No Log")
    {
        $missingMeals[] = "Breakfast";
    }

    if($lunchFood == "No Log")
    {
        $missingMeals[] = "Lunch";
    }

    if($dinnerFood == "No Log")
    {
        $missingMeals[] = "Dinner";
    }
?>

    <h2><?php echo $name; ?></h2>

    <p>
        <strong>Goal:</strong>
        <?php echo $goal; ?>
    </p>

    <?php if(count($missingMeals) > 0) { ?>

        <div style="
            background:#ffe5e5;
            color:#b30000;
            padding:15px;
            border-radius:10px;
            width:400px;
            margin-bottom:15px;
            font-weight:bold;">
            
            ❌ Missing Food Log:
            <?php echo implode(", ", $missingMeals); ?>

        </div>

        <form method="POST">

            <input type="hidden"
                   name="client_id"
                   value="<?php echo $client_id; ?>">

            <input type="hidden"
                   name="missing_meals"
                   value="<?php echo implode(', ', $missingMeals); ?>">

            <button
                type="submit"
                name="notify"
                style="
                    background:#ff9800;
                    color:white;
                    border:none;
                    padding:10px 20px;
                    border-radius:8px;
                    cursor:pointer;
                    margin-bottom:20px;">

                Notify Client

            </button>

        </form>

    <?php } else { ?>

        <div style="
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:10px;
            width:300px;
            margin-bottom:20px;
            font-weight:bold;">
            
            ✅ Logged Today

        </div>

    <?php } ?>

    <div style="display:flex; justify-content:center; gap:30px; margin-top:20px;">

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:250px;">
            <h3>Breakfast</h3>
            <p>Food Name: <?php echo $breakfastFood; ?></p>
            <p>Calories: <?php echo $breakfastCal; ?> kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:250px;">
            <h3>Lunch</h3>
            <p>Food Name: <?php echo $lunchFood; ?></p>
            <p>Calories: <?php echo $lunchCal; ?> kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:250px;">
            <h3>Dinner</h3>
            <p>Food Name: <?php echo $dinnerFood; ?></p>
            <p>Calories: <?php echo $dinnerCal; ?> kcal</p>
        </div>

    </div>

    <br>

    <a href="coach_clients.php">← Back</a>

<?php
}
else
{
    $sql = "SELECT users.name,
                   client.client_id,
                   client.goal
            FROM client
            INNER JOIN users
            ON client.user_id = users.user_id
            WHERE client.coach_id = '$coach_id'";

    $result = mysqli_query($conn, $sql);

    echo '<div style="display:flex; gap:20px; flex-wrap:wrap;">';

    while($row = mysqli_fetch_assoc($result))
    {
?>

        <a href="coach_clients.php?client_id=<?php echo $row['client_id']; ?>"
           style="text-decoration:none; color:black;">

            <div style="
                border:1px solid #ccc;
                padding:20px;
                border-radius:10px;
                width:220px;
                cursor:pointer;">

                <h3><?php echo $row['name']; ?></h3>

                <p>
                    <strong>Client ID:</strong>
                    <?php echo $row['client_id']; ?>
                </p>

                <p>
                    <strong>Goal:</strong>
                    <?php echo $row['goal']; ?>
                </p>

            </div>

        </a>

<?php
    }

    echo '</div>';
}
?>

</div>

</body>
</html>