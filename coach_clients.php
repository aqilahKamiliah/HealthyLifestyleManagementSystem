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
if(isset($_GET['name'])) {
    $name = $_GET['name'];
?>

    <!-- ✅ PAGE DETAIL (Makanan) -->
    <h2><?php echo $name; ?></h2>

    <div style="display:flex; justify-content:center; gap:30px; margin-top:30px;">

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Breakfast</h3>
            <p>Food Name: Oatmeal</p>
            <p>Calories: 300 kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Lunch</h3>
            <p>Food Name: Chicken Rice</p>
            <p>Calories: 600 kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Dinner</h3>
            <p>Food Name: Salad</p>
            <p>Calories: 400 kcal</p>
        </div>

    </div>

    <br>
    <a href="coach_clients.php">← Back</a>

<?php
} else {
?>

    <!-- ✅ PAGE LIST (Client) -->
    <div style="display:flex; gap:20px;">

        <a href="coach_clients.php?name=Ali" style="text-decoration:none; color:black;">
            <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:200px; cursor:pointer;">
                <h3>Ali</h3>
                <p>Goal: Lose weight</p>
                <p>2185 kcal/day</p>
            </div>
        </a>

        <a href="coach_clients.php?name=Maya" style="text-decoration:none; color:black;">
            <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:200px; cursor:pointer;">
                <h3>Maya</h3>
                <p>Goal: Maintain weight</p>
                <p>1650 kcal/day</p>
            </div>
        </a>

        <a href="coach_clients.php?name=Adi" style="text-decoration:none; color:black;">
            <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:200px; cursor:pointer;">
                <h3>Adi</h3>
                <p>Goal: Gain weight</p>
                <p>2150 kcal/day</p>
            </div>
        </a>

    </div>

<?php
}
?>

</div>

</body>
</html>