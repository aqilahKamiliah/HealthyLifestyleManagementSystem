<?php
$client = isset($_GET['client']) ? $_GET['client'] : '';
include 'headerCoach.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>History Details</title>
    <link rel="stylesheet" type="text/css" href="style1.css">

    <style>
        .container {
            width: 90%;
            margin: 30px auto;
            text-align: center;
        }

        .history-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .history-box {
            width: 30%;
            min-width: 250px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: left;
            background: #fff;
        }

        .meal {
            border: 1px solid #eee;
            padding: 6px;
            margin: 5px 0;
            border-radius: 6px;
            font-size: 14px;
        }

        .total {
            font-weight: bold;
            margin-top: 10px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>

<div class="container">

<?php if($client == "Ali") { ?>

    <h2>Ali - History</h2>

    <div class="history-grid">

        <div class="history-box">
            <h3>12 April 2026</h3>
            <div class="meal">Breakfast: 500 kcal</div>
            <div class="meal">Lunch: 800 kcal</div>
            <div class="meal">Dinner: 885 kcal</div>
            <div class="meal">Exercise: Cardio 10 min</div>
            <div class="total">Total: 2185 kcal</div>
        </div>

        <div class="history-box">
            <h3>13 April 2026</h3>
            <div class="meal">Breakfast: 467 kcal</div>
            <div class="meal">Lunch: 863 kcal</div>
            <div class="meal">Dinner: 796 kcal</div>
            <div class="meal">Exercise: Planks 5 min</div>
            <div class="total">Total: 2126 kcal</div>
        </div>

        <div class="history-box">
            <h3>14 April 2026</h3>
            <div class="meal">Breakfast: 563 kcal</div>
            <div class="meal">Lunch: 986 kcal</div>
            <div class="meal">Dinner: 880 kcal</div>
            <div class="meal">Exercise: Push ups 30</div>
            <div class="total">Total: 2429 kcal</div>
        </div>

    </div>

    <a class="back" href="coach_history.php">← Back</a>

<?php } elseif($client == "Maya") { ?>

    <h2>Maya - History</h2>

    <div class="history-grid">

        <div class="history-box">
            <h3>13 April 2026</h3>
            <div class="meal">Breakfast: 700 kcal</div>
            <div class="meal">Lunch: 900 kcal</div>
            <div class="meal">Dinner: 1221 kcal</div>
            <div class="meal">Exercise: Strength 10 min</div>
            <div class="total">Total: 2821 kcal</div>
        </div>

    </div>

    <a class="back" href="coach_history.php">← Back</a>

<?php } elseif($client == "Adi") { ?>

    <h2>Adi - History</h2>

    <div class="history-grid">

        <div class="history-box">
            <h3>14 April 2026</h3>
            <div class="meal">Breakfast: 600 kcal</div>
            <div class="meal">Lunch: 850 kcal</div>
            <div class="meal">Dinner: 700 kcal</div>
            <div class="meal">Exercise: Gym 20 min</div>
            <div class="total">Total: 2150 kcal</div>
        </div>

    </div>

    <a class="back" href="coach_history.php">← Back</a>

<?php } else { ?>

    <h2>No Client Selected</h2>
    <a class="back" href="coach_history.php">← Back to History</a>

<?php } ?>

</div>

</body>
</html>

