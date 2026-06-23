<!DOCTYPE html>
<html>
<head>
    <title>Select Food</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<?php
include 'connection.php';
include 'headerCoach.php';

$client_id = $_GET['client_id'];
$meal = $_GET['meal'];
?>

<div style="width:85%; margin:30px auto;">

<h2>Food Selection (<?php echo $meal; ?>)</h2>

<form action="recommend_submit.php" method="POST">

<input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
<input type="hidden" name="meal" value="<?php echo $meal; ?>">

<div style="display:flex; gap:15px;">

    <!-- Fruits / Vegetables -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Fruits / Vegetables</h3>

        <?php
        $sql = "SELECT * FROM Food WHERE category='Fruit/Vegetable'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            echo '<input type="checkbox" name="food[]" value="'.$row['food_id'].'|'.$row['calorie'].'">
            '.$row['food_name'].' ('.$row['calorie'].' kcal)<br>';
        }
        ?>
    </div>

    <!-- Carbohydrates -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Carbohydrates</h3>

        <?php
        $sql = "SELECT * FROM Food WHERE category='Carbohydrate'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            echo '<input type="checkbox" name="food[]" value="'.$row['food_id'].'|'.$row['calorie'].'">
            '.$row['food_name'].' ('.$row['calorie'].' kcal)<br>';
        }
        ?>
    </div>

    <!-- Protein -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Protein</h3>

        <?php
        $sql = "SELECT * FROM Food WHERE category='Protein'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            echo '<input type="checkbox" name="food[]" value="'.$row['food_id'].'|'.$row['calorie'].'">
            '.$row['food_name'].' ('.$row['calorie'].' kcal)<br>';
        }
        ?>
    </div>

    <!-- Beverages -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Beverages</h3>

        <?php
        $sql = "SELECT * FROM Food WHERE category='Beverage'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            echo '<input type="checkbox" name="food[]" value="'.$row['food_id'].'|'.$row['calorie'].'">
            '.$row['food_name'].' ('.$row['calorie'].' kcal)<br>';
        }
        ?>
    </div>

</div>

<br>

<button type="submit" style="padding:10px 20px; background:#6a5acd; color:white; border:none; border-radius:5px;">
    Next
</button>

</form>

</div>

</body>
</html>