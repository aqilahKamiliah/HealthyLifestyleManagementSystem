<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>
<body>
    <header>
        <div class="headTittle">
        <?php
        $sytemName= "Healthy LifeStyle Management System";
        echo "<h1 class='center'>".$sytemName."</h1>";
        ?>
        </div>

        <nav>
        <a href = "homeAdmin.php"> Home </a > 
        <a href = "listClient.php"> Client </a > 
        <a href = "listCoach.php"> Coach </a > 
        <a href = "listFood.php"> Food </a > 
        <a href = "logOut.php"> Log Out </a > 
        </nav>
    </header>
    
</body>
</html>