<?php
include 'connection.php';

if(isset($_POST['register']))
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $role = 'client'; 
    $check_email = "SELECT * FROM Users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($result) > 0) {
        echo "<script>alert('This email is already registered'); window.location.href='index.php';</script>";
    } else {
        $sql = "INSERT INTO Users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert(''Account created successfully! Please log in.'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>