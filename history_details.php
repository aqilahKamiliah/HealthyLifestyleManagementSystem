<?php
include 'connection.php';
include 'headerCoach.php';

$client_id = $_GET['client_id'];
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

        .history-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin: 15px auto;
            width: 60%;
            background: #fff;
            text-align: left;
        }

        .meal {
            padding: 5px;
            margin: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .total {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Client History</h2>

<?php

$sql = "
    SELECT *
    FROM Progress
    WHERE client_id = $client_id
    ORDER BY date DESC
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {

        echo '
        <div class="history-box">
            <h3>Date: '.$row['date'].'</h3>
            <div class="total">Weight: '.$row['weight'].' kg</div>
        </div>
        ';
    }

} else {
    echo "<p>No history found for this client.</p>";
}

?>

<a href="coach_history.php">← Back</a>

</div>

</body>
</html>