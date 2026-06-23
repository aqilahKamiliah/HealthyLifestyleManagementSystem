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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $experience = (int)$_POST['experience']; 
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // 1. Check if passwords match
    if($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } 
    // 2. Check if email already exists
    else {
        $checkEmail = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmail);
        
        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('This email is already registered!');</script>";
        } else {
            // 3. Proceed with registration
            $sqlUser = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'coach')";
            
            if(mysqli_query($conn, $sqlUser)) {
                $newUserId = mysqli_insert_id($conn);

                $sqlCoach = "INSERT INTO coach (specialization, experience_years, user_id) VALUES ('$specialization', '$experience', '$newUserId')";
                
                if(mysqli_query($conn, $sqlCoach)) {
                    echo "<script>alert('Coach registered successfully!');</script>";
                } else {
                    echo "<script>alert('Error adding coach profile!');</script>";
                }
            } else {
                echo "Error adding user: " . mysqli_error($conn);
            }
        }
    }
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
<tr>	<td>Specialization</td>
<td><input type = "text" name = "specialization" /></td>	
</tr>
<tr>    <td>Experience (Years)</td>
<td><input type = "number" name = "experience" /></td>
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