<?php
session_start();
<<<<<<< HEAD
// 1. Panggil sambungan database korang
=======
>>>>>>> b9a38c4d7837720804f16ad179650b89141f5b26
include 'connection.php';

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

<<<<<<< HEAD
    // 2. Buat query SQL untuk cari user berdasarkan email & password yang ditaip
    $query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Jika user dijumpai dalam database
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        // 3. SIMPAN DATA DALAM SESSION (Penting untuk sekatan Shana & guna di client_home)
        $_SESSION['user_id'] = $row['user_id']; // Ambil 'user_id' dari database (cth: Ali = 2)
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role']; // Ambil 'client', 'coach', atau 'admin'

        // 4. Hantar pengguna ke halaman utama mengikut 'role' masing-masing
=======
    $sql = "SELECT * FROM users 
            WHERE email = '$email' 
            AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];

>>>>>>> b9a38c4d7837720804f16ad179650b89141f5b26
        if($row['role'] == 'client')
        {
            header("Location: client_bio.php");
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
<<<<<<< HEAD
        // Jika data tiada atau salah taip
        echo "<script>
                alert('Invalid email or password');
                window.location.href='index.php';
              </script>";
=======
        echo "<script>alert('Invalid email or password');</script>";
    }
}

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "client";

    $check = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $check);

    if(mysqli_num_rows($checkResult) > 0)
    {
        echo "<script>alert('Email already exists!');</script>";
    }
    else
    {
        $insert = "INSERT INTO users (name, email, password, role)
                   VALUES ('$name', '$email', '$password', '$role')";

        if(mysqli_query($conn, $insert))
        {
            echo "<script>
                    alert('Account created successfully! Please login.');
                    window.location.href='index.php';
                  </script>";
        }
        else
        {
            echo 'Error: ' . mysqli_error($conn);
        }
>>>>>>> b9a38c4d7837720804f16ad179650b89141f5b26
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

    <p>Track your health, achieve your goals,
        and stay connected with your coach.
    </p>
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

<div id="registerForm" class="form-container">
    <h2>Create Account</h2>

    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="Enter your full name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Create password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <button type="button" class="secondary-btn" onclick="showLogin()">Cancel</button>
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
</script>

</body>
</html>