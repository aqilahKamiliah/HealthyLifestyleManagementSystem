<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['log_id'])) {
    $log_id = $_POST['log_id'];

    $sql = "DELETE FROM exercise_logs
            WHERE log_id = '$log_id'";

    mysqli_query($conn, $sql);
}

header("Location: client_home.php");
exit();
?>