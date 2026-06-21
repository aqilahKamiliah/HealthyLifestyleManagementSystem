<!DOCTYPE html>
<html>
<head>
    <title>Select Food</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<?php include 'headerCoach.php'; ?>

<div style="width:85%; margin:30px auto;">

<?php
$client = $_GET['client'];
$meal = $_GET['meal'];
?>

<h2><?php echo $client; ?> - <?php echo $meal; ?> Recommendation</h2>

<form action="recommend_submit.php" method="POST">

<input type="hidden" name="client" value="<?php echo $client; ?>">
<input type="hidden" name="meal" value="<?php echo $meal; ?>">

<div style="display:flex; gap:15px;">

    <!-- FRUITS -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Fruits / Vegetables</h3>
        <input type="checkbox" name="food[]" value="Apple|80"> Apple (80 kcal)<br>
        <input type="checkbox" name="food[]" value="Banana|100"> Banana (100 kcal)<br>
        <input type="checkbox" name="food[]" value="Broccoli|50"> Broccoli (50 kcal)
    </div>

    <!-- CARB -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Carbohydrates</h3>
        <input type="checkbox" name="food[]" value="Rice|200"> Rice (200 kcal)<br>
        <input type="checkbox" name="food[]" value="Bread|150"> Bread (150 kcal)<br>
        <input type="checkbox" name="food[]" value="Pasta|220"> Pasta (220 kcal)
    </div>

    <!-- PROTEIN -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Protein</h3>
        <input type="checkbox" name="food[]" value="Chicken|250"> Chicken (250 kcal)<br>
        <input type="checkbox" name="food[]" value="Egg|70"> Egg (70 kcal)<br>
        <input type="checkbox" name="food[]" value="Fish|180"> Fish (180 kcal)
    </div>

    <!-- DRINKS -->
    <div style="border:1px solid #ccc; padding:15px; width:23%;">
        <h3>Beverages</h3>
        <input type="checkbox" name="food[]" value="Water|0"> Water (0 kcal)<br>
        <input type="checkbox" name="food[]" value="Juice|120"> Juice (120 kcal)<br>
        <input type="checkbox" name="food[]" value="Milk|130"> Milk (130 kcal)
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