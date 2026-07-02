<?php
include("connection.php");

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Delete from coach profile first (due to foreign key)
    mysqli_query($conn, "DELETE FROM coach WHERE user_id = $id");
    // Then delete the user
    mysqli_query($conn, "DELETE FROM users WHERE user_id = $id");
    
    header("Location: listCoach.php");
}
?>