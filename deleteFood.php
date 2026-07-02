<?php
include("connection.php");

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM food WHERE food_id = $id";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: listFood.php?msg=deleted");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>