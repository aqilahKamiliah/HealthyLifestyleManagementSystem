<?php
$client = isset($_GET['client']) ? $_GET['client'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coach History Details</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<h1>Coach History</h1>

<nav>
    <a href="coach_home.php">Home</a> |
    <a href="coach_profile.php">Profile</a> |
    <a href="coach_clients.php">Clients</a> |
    <a href="coach_evaluation.php">Evaluation</a> |
    <a href="coach_history.php">History</a> |
    <a href="coach_suggestions.php">Suggestions</a>
</nav>

<hr>

<?php if($client == "Ali") { ?>

    <h2>Ali</h2>

    <div class="history-record">

        <h3>12 April 2026</h3>

        <p><strong>Breakfast:</strong> 500 kcal</p>
        <p><strong>Lunch:</strong> 800 kcal</p>
        <p><strong>Dinner:</strong> 885 kcal</p>

        <p><strong>Exercise:</strong> Cardio 10 min</p>

        <h4>Total: 2185 kcal</h4>

    </div>

<?php } ?>

<?php if($client == "Maya") { ?>

    <h2>Maya</h2>

    <div class="history-record">

        <h3>13 April 2026</h3>

        <p><strong>Breakfast:</strong> 700 kcal</p>
        <p><strong>Lunch:</strong> 900 kcal</p>
        <p><strong>Dinner:</strong> 1221 kcal</p>

        <p><strong>Exercise:</strong> Strength Training 10 min</p>

        <h4>Total: 2821 kcal</h4>

    </div>

<?php } ?>

<?php if($client != "Ali" && $client != "Maya") { ?>

    <h2>No Client Selected</h2>
    <p>Please return to the history page and select a client.</p>

<?php } ?>

</body>
</html>