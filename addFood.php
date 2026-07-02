<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>
<body>
<?php 
include("headerAdmin.php");
include("connection.php");

if(isset($_POST['submit'])) {
    // Sanitize input to prevent SQL injection
    $foodName = mysqli_real_escape_string($conn, $_POST['foodName']);
    $category = mysqli_real_escape_string($conn, $_POST['categories']);
    $calories = (int)$_POST['calories']; // Ensure calories is an integer

    // 1. Check if the food name already exists in the database
    $checkFood = "SELECT food_name FROM food WHERE food_name = '$foodName'";
    $result = mysqli_query($conn, $checkFood);

    if(mysqli_num_rows($result) > 0) {
        // Food already exists
        echo "<script>alert('This food already exists!');</script>";
    } else {
        // 2. If it does not exist, proceed with insertion
        $sql = "INSERT INTO food (food_name, category, calorie) VALUES ('$foodName', '$category', '$calories')";
        
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('Food added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding food!');</script>";
        }
    }
  }
?>

<section>
<div class="container">
  <div class="coachContainer">
<h3 class="center">Register New Food</h3>
<form method="POST" action="addFood.php">
<!-- create four text boxes for admin register Coach -->
<table>
<tr>	<td>Food Name</td>
<td><input type="text" name="foodName" /></td>	
</tr>
<tr>	<td>Categories</td> 	
<td>
<select name="categories" id="categories">
  <option value="Protein">Protein</option>
  <option value="Carbohydrate">Carbohydrate</option>
  <option value="Fruits/Vegetable">Fruits/Vegetable</option>
  <option value="Beverages">Beverages</option>
</select>
</tr> 
<tr>	<td>Calories (kcal)</td>
<td><input type = "number" name = "calories" required/></td>	
</tr>
<tr>
<br />
<!-- create a submit button -->
<td colspan="2"><input name="submit" type="submit" value= "Submit Form"/>     
<input type="reset" value="Clear Form"/> </td>
</tr>
	</table>
	</form>
</div>
</div>
</section>

</body>
</html>