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

    <p>Track your health, achieve your goals,
        and stay connected with your coach.
    </p>
</div>

<div id="loginForm" class="form-container">
    <h2>Login</h2>

    <input type="email" placeholder="Enter your email">
    <input type="password" placeholder="Enter your password">

    <button class="primary-btn">Login</button>

    <button class="secondary-btn" onclick="showRegister()">Create Account</button>
</div>

<div id="registerForm" class="form-container">
    <h2>Create Account</h2>

    <input type="text" placeholder="Enter your full name">
    <input type="email" placeholder="Enter your email">
    <input type="password" placeholder="Create password">

    <button onclick="registerSuccess()">Register</button>

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
        document.getElementById("registerForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
    }
</script>

</body>
</html>