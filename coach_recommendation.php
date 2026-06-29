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

<?php
include 'connection.php';
include 'headerCoach.php';

session_start();

$user_id = $_SESSION['user_id'];

$coachQuery = "SELECT coach_id FROM coach WHERE user_id = '$user_id'";
$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recommendation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<div style="width:80%; margin:30px auto;">

<h2>Make Recommendation</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">

<?php

$sql = "
SELECT Client.Client_id, Users.name, Client.weight
FROM Client
JOIN Users ON Users.user_id = Client.user_id
WHERE Client.coach_id = $coach_id
";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {

    echo '
    <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:220px;">
        <h3>'.$row['name'].'</h3>
        <p>Weight: '.$row['weight'].' kg</p>

        <a class="meal-box" href="recommend_food.php?client_id='.$row['Client_id'].'&meal=Breakfast">Breakfast</a>
        <a class="meal-box" href="recommend_food.php?client_id='.$row['Client_id'].'&meal=Lunch">Lunch</a>
        <a class="meal-box" href="recommend_food.php?client_id='.$row['Client_id'].'&meal=Dinner">Dinner</a>
    </div>
    ';
}

?>

</div>
</div>

</body>
</html>