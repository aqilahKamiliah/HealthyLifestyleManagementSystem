<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];

$coachQuery = "SELECT coach_id FROM coach WHERE user_id = '$user_id'";
$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

$sql = "SELECT cs.session_id, cs.client_id, cs.start_date, cs.end_date, cs.status,
               c.weight, u.name
        FROM coaching_session cs
        JOIN client c ON cs.client_id = c.client_id
        JOIN users u ON c.user_id = u.user_id
        WHERE cs.coach_id = '$coach_id'
        ORDER BY cs.session_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recommendation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">

<style>
.meal-box{
display:block;
text-decoration:none;
color:black;
border:1px solid #ccc;
padding:10px;
margin-top:10px;
border-radius:8px;
text-align:center;
background-color:#f8f8f8;
transition:0.3s;
}

.meal-box:hover{
background-color:#e6e6ff;
border-color:#6a5acd;
color:#6a5acd;
cursor:pointer;
}

.meal-box:active{
background-color:#d6d6ff;
transform:scale(0.98);
}
</style>

</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

<h2>Make Recommendation</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

<?php
while($row = mysqli_fetch_assoc($result))
{
    $today = date("Y-m-d");

    $sessionEnded = false;

    if($row['status'] == "Expired")
    {
        $sessionEnded = true;
    }
    else if($row['end_date'] <= $today)
    {
        $sessionEnded = true;
    }
?>

<div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:220px;">

<h3><?php echo $row['name']; ?></h3>

<p>Weight: <?php echo $row['weight']; ?> kg</p>

<p>
Session:<br>
<?php echo $row['start_date']; ?> - <?php echo $row['end_date']; ?>
</p>

<?php
if(!$sessionEnded)
{
?>

<a class="meal-box"
href="recommend_food.php?client_id=<?php echo $row['client_id']; ?>&session_id=<?php echo $row['session_id']; ?>&meal=Breakfast">
Breakfast
</a>

<a class="meal-box"
href="recommend_food.php?client_id=<?php echo $row['client_id']; ?>&session_id=<?php echo $row['session_id']; ?>&meal=Lunch">
Lunch
</a>

<a class="meal-box"
href="recommend_food.php?client_id=<?php echo $row['client_id']; ?>&session_id=<?php echo $row['session_id']; ?>&meal=Dinner">
Dinner
</a>

<?php
}
else
{
?>

<div style="margin-top:10px; background:#ffe5e5; color:red; padding:10px; border-radius:8px; text-align:center; font-weight:bold;">
Session Ended
</div>

<?php
}
?>

</div>

<?php
}
?>

</div>

</div>

</body>
</html>