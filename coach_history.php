<?php include 'headerCoach.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Coach History</title>
    <link rel="stylesheet" type="text/css" href="style1.css">

    <style>
        .container {
            width: 90%;
            margin: 30px auto;
            text-align: center;
        }

        .client-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .client-card {
            width: 30%;
            min-width: 250px;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            background: #fff;
            transition: 0.3s;
        }

        .client-card:hover {
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Coach History</h2>
    <p>Select a client to view their full history</p>

    <div class="client-grid">

        <a href="history_details.php?client=Ali" style="text-decoration:none; color:black;">
            <div class="client-card">
                <h3>Ali</h3>
                <p>Goal: Lose Weight</p>
                <p>2185 kcal/day</p>
            </div>
        </a>

        <a href="history_details.php?client=Maya" style="text-decoration:none; color:black;">
            <div class="client-card">
                <h3>Maya</h3>
                <p>Goal: Maintain Weight</p>
                <p>1650 kcal/day</p>
            </div>
        </a>

        <a href="history_details.php?client=Adi" style="text-decoration:none; color:black;">
            <div class="client-card">
                <h3>Adi</h3>
                <p>Goal: Gain Weight</p>
                <p>2150 kcal/day</p>
            </div>
        </a>

    </div>

</div>

</body>
</html>

