<?php
session_start();
include 'connection.php';

/* =========================
   CHECK LOGIN
========================= */
if(!isset($_SESSION['user_id']))
{
    die("Please login first.");
}

$user_id = $_SESSION['user_id'];

/* =========================
   GET CLIENT ID
========================= */
$sql = "SELECT Client_id FROM Client WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if(!$result || mysqli_num_rows($result) == 0)
{
    die("Client not found.");
}

$row = mysqli_fetch_assoc($result);
$client_id = $row['Client_id'];

/* =========================
   GET FORM DATA
========================= */
$meal = $_POST['meal'];
$food_item = $_POST['food_item'];
$food_weight = $_POST['food_weight'];

/* =========================
   GET REAL CALORIES FROM FOOD TABLE
========================= */
$sqlFood = "SELECT calorie FROM Food WHERE food_name = '$food_item'";
$resultFood = mysqli_query($conn, $sqlFood);

if($rowFood = mysqli_fetch_assoc($resultFood))
{
    $calorie = $rowFood['calorie'];
}
else
{
    $calorie = 0; // fallback if food not found
}

/* =========================
   INSERT INTO FOOD LOGS
========================= */
$sqlInsert = "
INSERT INTO Food_Logs
(food_names, calorie, meal_type, date, client_id)
VALUES
('$food_item', '$calorie', '$meal', CURDATE(), '$client_id')
";

if(mysqli_query($conn, $sqlInsert))
{
    echo "<script>
        alert('Food log saved successfully!');
        window.location='client_home.php';
    </script>";
}
else
{
    echo "Error: " . mysqli_error($conn);
}
?>