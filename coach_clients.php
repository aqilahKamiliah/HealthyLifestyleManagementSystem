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

if(isset($_GET['client_id']) && isset($_GET['session_id']))
{
    $client_id = $_GET['client_id'];
    $session_id = $_GET['session_id'];

    $clientQuery = "SELECT users.name,
                           client.goal,
                           coaching_session.duration_month,
                           coaching_session.start_date,
                           coaching_session.end_date,
                           coaching_session.status
                    FROM coaching_session
                    INNER JOIN client
                    ON coaching_session.client_id = client.client_id
                    INNER JOIN users
                    ON client.user_id = users.user_id
                    WHERE coaching_session.session_id = '$session_id'
                    AND coaching_session.client_id = '$client_id'";

    $clientResult = mysqli_query($conn, $clientQuery);
    $clientData = mysqli_fetch_assoc($clientResult);

    $name = $clientData['name'];
    $goal = $clientData['goal'];
    $duration = $clientData['duration_month'];
    $start_date = $clientData['start_date'];
    $end_date = $clientData['end_date'];
    $status = $clientData['status'];

    $today = strtotime(date("Y-m-d"));
    $end = strtotime($end_date);
    $remaining = floor(($end - $today) / 86400);

    if($remaining < 0)
    {
        $remaining = 0;
    }

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

<p><strong>Goal:</strong> <?php echo $goal; ?></p>

<div style="
background:#f8f9fa;
border:1px solid #ddd;
border-radius:10px;
padding:20px;
margin-bottom:25px;">

<h3>Coaching Session</h3>

<p><strong>Duration:</strong> <?php echo $duration; ?> Month(s)</p>

<p><strong>Start Date:</strong> <?php echo $start_date; ?></p>

<p><strong>End Date:</strong> <?php echo $end_date; ?></p>

<p><strong>Status:</strong> <?php echo $status; ?></p>

<p><strong>Remaining:</strong> <?php echo $remaining; ?> Day(s)</p>

</div>

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
                   client.goal,
                   coaching_session.session_id,
                   coaching_session.duration_month,
                   coaching_session.start_date,
                   coaching_session.end_date,
                   coaching_session.status
            FROM coaching_session
            INNER JOIN client
            ON coaching_session.client_id = client.client_id
            INNER JOIN users
            ON client.user_id = users.user_id
            WHERE coaching_session.coach_id = '$coach_id'
            AND coaching_session.status = 'Active'
            ORDER BY coaching_session.end_date ASC";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        echo '<div style="display:flex; gap:20px; flex-wrap:wrap;">';

        while($row = mysqli_fetch_assoc($result))
        {
            $today = strtotime(date("Y-m-d"));
            $end = strtotime($row['end_date']);
            $remaining = floor(($end - $today) / 86400);

            if($remaining < 0)
            {
                $remaining = 0;
            }
?>

        <a href="coach_clients.php?client_id=<?php echo $row['client_id']; ?>&session_id=<?php echo $row['session_id']; ?>"
           style="text-decoration:none; color:black;">

            <div style="
                border:1px solid #ccc;
                padding:20px;
                border-radius:10px;
                width:250px;
                cursor:pointer;
                background:white;
                box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                <h3><?php echo $row['name']; ?></h3>

                <p>
                    <strong>Client ID:</strong>
                    <?php echo $row['client_id']; ?>
                </p>

                <p>
                    <strong>Goal:</strong>
                    <?php echo $row['goal']; ?>
                </p>

                <hr>

                <p>
                    <strong>Duration:</strong>
                    <?php echo $row['duration_month']; ?> Month(s)
                </p>

                <p>
                    <strong>Start:</strong>
                    <?php echo $row['start_date']; ?>
                </p>

                <p>
                    <strong>End:</strong>
                    <?php echo $row['end_date']; ?>
                </p>

                <p>
                    <strong>Remaining:</strong>
                    <?php echo $remaining; ?> Day(s)
                </p>

                <p>
                    <strong>Status:</strong>

                    <?php
                    if($row['status'] == "Active")
                    {
                        echo "<span style='color:green;font-weight:bold;'>Active</span>";
                    }
                    else
                    {
                        echo "<span style='color:red;font-weight:bold;'>Completed</span>";
                    }
                    ?>
                </p>

            </div>

        </a>

<?php
        }

        echo '</div>';
    }
    else
    {
?>

    <div style="
        background:white;
        padding:30px;
        border-radius:10px;
        text-align:center;
        border:1px solid #ddd;">

        <h3>No Active Clients</h3>

        <p>
            You currently do not have any active coaching sessions.
        </p>

    </div>

<?php
    }
}
?>

</div>

</body>
</html>