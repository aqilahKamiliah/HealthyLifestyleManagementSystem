<?php
include 'connection.php';
include 'headerCoach.php';

$client_id = $_POST['client_id'];
$meal = $_POST['meal'];
$foods = isset($_POST['food']) ? $_POST['food'] : [];

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Recommendation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<div style="width:70%; margin:30px auto;">

<h2>Recommendation Summary</h2>

<div style="border:1px solid #ccc; padding:20px; border-radius:10px;">

<h3><?php echo $meal; ?> Recommendation</h3>

<table style="width:100%; text-align:left;">
<tr>
    <th>Food</th>
    <th>Calories</th>
</tr>

<?php

foreach($foods as $f)
{
    list($food_id, $calorie) = explode("|", $f);

    $food_sql = "SELECT food_name FROM Food WHERE food_id = $food_id";
    $food_result = mysqli_query($conn, $food_sql);

    if($food_row = mysqli_fetch_assoc($food_result))
    {
        $food_name = $food_row['food_name'];

        echo "
        <tr>
            <td>$food_name</td>
            <td>$calorie kcal</td>
        </tr>
        ";

        $total += $calorie;
    }
}
?>

</table>

<hr>

<h3>Total Calories: <?php echo $total; ?> kcal</h3>

<br>

<hr>

<h3>Total Calories: <?php echo $total; ?> kcal</h3>

<form action="save_recommendation.php" method="POST">

    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
    <input type="hidden" name="meal" value="<?php echo $meal; ?>">

    <?php
    foreach($foods as $food)
    {
        echo '<input type="hidden" name="food[]" value="'.$food.'">';
    }
    ?>

    <br>

    <button
    type="submit"
    style="padding:10px 20px; background:green; color:white; border:none; border-radius:5px;">
        Submit Recommendation
    </button>

</form>

</body>
</html>