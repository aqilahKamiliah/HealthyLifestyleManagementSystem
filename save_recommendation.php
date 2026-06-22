<?php

include 'connection.php';

$client_id = $_POST['client_id'];
$meal = $_POST['meal'];
$foods = $_POST['food'];

// TEMP coach id
$coach_id = 1;

$date = date("Y-m-d");

$sql = "
INSERT INTO Recommendation
(client_id, coach_id, type, date)
VALUES
($client_id, $coach_id, '$meal', '$date')
";

mysqli_query($conn, $sql);

$rec_id = mysqli_insert_id($conn);

foreach($foods as $f)
{
    list($food_id, $calorie) = explode("|", $f);

    $sql2 = "
    INSERT INTO Recommendation_Food
    (rec_id, food_id)
    VALUES
    ($rec_id, $food_id)
    ";

    mysqli_query($conn, $sql2);
}

echo "
<script>
alert('Recommendation submitted successfully!');
window.location='coach_recommendation.php';
</script>
";
?>