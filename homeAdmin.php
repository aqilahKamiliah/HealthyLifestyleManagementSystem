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
    include "headerAdmin.php";
    include 'connection.php';

    // Function to get counts from your specific table names
    function getCount($table, $conn) {
    $sql = "SELECT COUNT(*) as total FROM $table";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
    }

// Fetching counts based on the table names in image_8e0987.png
    $totalClient = getCount("client", $conn);
    $totalCoaches = getCount("coach", $conn);
    $totalFood = getCount("food", $conn);
    ?>

    <div class='dashboard'>
    <div class='card'>
        <h4> Total Clients </h4>
        <p><?php echo $totalClient; ?></p>
        <a href="listClient.php"> View Clients </a>
    </div>

    <div class='card'>
        <h4> Total Coaches </h4>
        <p><?php echo $totalCoaches; ?></p>
        <a href="listCoach.php"> View Coaches </a>
    </div>

    <div class='card'>
        <h4> Total Food </h4>
        <p><?php echo $totalFood; ?></p>
        <a href="listFood.php"> View Food </a>
    </div>
    </div>
</body>
</html>