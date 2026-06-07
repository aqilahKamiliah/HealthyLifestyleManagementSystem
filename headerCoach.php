<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<header>

    <div class="headTittle">
        <?php
        $sytemName = "Healthy LifeStyle Management System";
        echo "<h1 class='center'>" . $sytemName . "</h1>";
        ?>
    </div>

   <nav>
    <a href="coach_profile.php">Profile</a> 
    <a href="coach_home.php">Home</a> 
    <a href="coach_clients.php">Client</a> 
    <a href="coach_recommendation.php">Recommendation</a> 
    <a href="coach_evaluation.php">Evaluation</a> 
    <a href="coach_history.php">History</a> 
    <a href="logOutCoach.php">Log Out</a> 
</nav>

</header>

</body>
</html>
