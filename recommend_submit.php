<!DOCTYPE html>
<html>
<head>
    <title>Submit Recommendation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<?php include 'headerCoach.php'; ?>

<div style="width:70%; margin:30px auto;">

<?php
$client = $_POST['client'];
$meal = $_POST['meal'];
$foods = $_POST['food'];

$total = 0;
?>

<h2>Recommendation Summary</h2>

<div style="border:1px solid #ccc; padding:20px; border-radius:10px;">

<h3><?php echo $client; ?> - <?php echo $meal; ?></h3>

<table style="width:100%; text-align:left;">
<tr>
    <th>Food</th>
    <th>Calories</th>
</tr>

<?php
foreach($foods as $f) {
    list($name, $cal) = explode("|", $f);
    $total += $cal;

    echo "<tr>
            <td>$name</td>
            <td>$cal kcal</td>
          </tr>";
}
?>

</table>

<hr>

<h3>Total Calories: <?php echo $total; ?> kcal</h3>

<br>

<button onclick="alert('Recommendation sent successfully!')" 
style="padding:10px 20px; background:green; color:white; border:none; border-radius:5px;">
Submit
</button>

</div>

<br>
<a href="coach_recommendation.php"> Back</a>

</div>

</body>
</html>