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

	$myTextFile = 'coachList.txt';
    if(isset($_POST['submit'])) {

    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if($password == $confirmPassword)
    {
        echo "Password matched!";
    }
    else
    {
        echo "Passwords do not match!";
    }
	
	$data = array($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['specialization'], $_POST['password']);

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
<h3 class="center">Register New Coach</h3>
<form method="POST" action="addCoach.php">
<!-- create four text boxes for admin register Coach -->
<table>
<tr>	<td>Name</td>
<td><input type="text" name="name" /></td>	
</tr>
<tr>	<td>Email</td> 	
<td> <input type = "text" name = "email" /></td>
</tr> 
<tr>	<td>Phone Number</td>
<td><input type = "text" name = "phone" /></td>	
</tr>
<tr>    <td>Specialization</td>
<td><input type = "text" name = "specialization" /></td>
</tr>
<tr>	<td>Password</td>
<td><input type = "password" name = "password" /></td>
</tr>
<tr>	<td>Confirm Password</td>
<td><input type = "password" name = "confirmPassword" /></td>
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