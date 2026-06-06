<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
</head>
<body>
    <?php
    include "headerAdmin.php";

    $totalClient= "6";
    $totalCoaches= "3";
    $totalFood= "6";

    echo "<div class=\"boxTotal\">";
    echo "<h5> Total Clients </h5>";
    echo "<p>".$totalClient."</p>";
    echo "<a href = \"listClient.php\"> View Clients </a >";
    echo "</div>";

    echo "<div class=\"boxTotal\">";
    echo "<h5> Total Coaches </h5>";
    echo "<p>".$totalCoaches."</p>";
    echo "<a href = \"listCoach.php\"> View Coaches </a >";
    echo "</div>";

    echo "<div class=\"boxTotal\">";
    echo "<h5> Total Food </h5>";
    echo "<p>".$totalFood."</p>";
    echo "<a href = \"listFood.php\"> View Food </a >";
    echo "</div>";
    ?>
</body>
</html>