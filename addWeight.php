<?php
session_start();
include("connection.php");

// Get logged in user id
$user_id = $_SESSION['user_id'];

// Get the actual Client_id
$result = mysqli_query($conn,"
SELECT Client_id
FROM Client
WHERE user_id='$user_id'
");

$row = mysqli_fetch_assoc($result);

$client_id = $row['Client_id'];

$weight = $_POST['weight'];
$date = date('Y-m-d');

// Check latest weight
$check = mysqli_query($conn,"
SELECT date
FROM progress
WHERE client_id='$client_id'
ORDER BY date DESC
LIMIT 1
");

if(mysqli_num_rows($check) > 0)
{
    $last = mysqli_fetch_assoc($check);

    $days = floor((strtotime($date) - strtotime($last['date'])) / 86400);

    if($days < 7)
    {
        echo "<script>
        alert('You have already updated your weight this week.');
        window.location='client_home.php';
        </script>";
        exit();
    }
}

// Save new weight
$sql = "INSERT INTO progress(weight, date, client_id)
VALUES('$weight', '$date', '$client_id')";

if(mysqli_query($conn, $sql))
{
    echo "<script>
        alert('Weight updated successfully!');
        window.location='client_home.php';
    </script>";
}
else
{
    echo mysqli_error($conn);
}
?>