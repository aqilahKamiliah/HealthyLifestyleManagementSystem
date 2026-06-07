<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>
<body>
<?php include("headerAdmin.php");

	$myTextFile = 'foodList.txt';
    if(isset($_POST['submit'])) {
        
	$data = array($_POST['foodName'],$_POST['categories'],$_POST['calories']);

	$fp = @fopen($myTextFile, 'a') 
	or die("Couldn't open file 	for writing!");

	@fwrite($fp, "\n");
	foreach ($data as $v) {
		@fwrite($fp, "$v\t");
	}
	
	@fclose($fp);
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
  <option value="Grains">Grains</option>
  <option value="Fruits">Fruits</option>
  <option value="Vegetables">Vegetables</option>
  <option value="Beverages">Beverages</option>
</select>
</tr> 
<tr>	<td>Calories (kcal)</td>
<td><input type = "text" name = "calories" /></td>	
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