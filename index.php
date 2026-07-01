<?php
session_start();
include 'connection.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id']; 
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role']; 

        if($row['role'] == 'client')
        {
            $user_id = $row['user_id'];
            $check_query = "SELECT * FROM client WHERE user_id = '$user_id'";
            $check_result = mysqli_query($conn, $check_query);

            if(mysqli_num_rows($check_result) > 0)
            {
                header("Location: client_home.php");
            }
            else
            {
                header("Location: client_bio.php");
            }
            exit();
        }
        else if($row['role'] == 'coach')
        {
            header("Location: coach_home.php");
            exit();
        }
        else if($row['role'] == 'admin')
        {
            header("Location: homeAdmin.php");
            exit();
        }
    }
    else
    {
        echo "<script>
                alert('Invalid email or password');
                window.location.href='index.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<div class="banner">
    <h1>Welcome to Healthy Lifestyle Management System</h1>
    <p>Track your health, achieve your goals, and stay connected with your coach.</p>
</div>

<div id="loginForm" class="form-container">
    <h2>Login</h2>
    <form action="index.php" method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit" name="submit" class="primary-btn">Login</button>
    </form>
    <button type="button" class="secondary-btn" onclick="showRegister()">Create Account</button>
</div>

<div id="registerForm" class="form-container" style="display:none;">
    <h2>Create Account</h2>
    <form action="process_register.php" method="POST">
        <input type="text" name="fullname" placeholder="Enter your full name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Create password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <button class="secondary-btn" onclick="showLogin()">Cancel</button>
</div>

<script>
function showRegister(){
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
}
function showLogin(){
    document.getElementById("registerForm").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
}
function registerSuccess(){
    alert("Account created successfully!");
    showLogin();
}
</script>

</body>
</html>
