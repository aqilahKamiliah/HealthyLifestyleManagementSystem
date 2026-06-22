<?php
include 'connection.php';
include 'headerCoach.php';

// TEMP: assume logged-in coach_id = 1 (later replace with session)
$coach_id = 1;
?>

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

        .page-title {
    text-align: center;
    margin-bottom: 20px;
}

.page-title h2 {
    margin-bottom: 5px;
}
    </style>
</head>

<body>

<div class="container">

    <div class="page-title">
        <h2>Coach History</h2>
        <p>Select a client to view their full history</p>
    </div>

    <div class="client-grid">

        <?php

        $sql = "
            SELECT 
                Client.Client_id,
                Users.name,
                Client.weight,
                Activity_Level.name AS activity
            FROM Client
            JOIN Users ON Users.user_id = Client.user_id
            JOIN Activity_Level ON Activity_Level.activity_level_id = Client.activity_level_id
            WHERE Client.coach_id = $coach_id
        ";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {

                echo '
                <a href="history_details.php?client_id='.$row['Client_id'].'" style="text-decoration:none; color:black;">
                    <div class="client-card">
                        <h3>'.$row['name'].'</h3>
                        <p>Activity: '.$row['activity'].'</p>
                        <p>Weight: '.$row['weight'].' kg</p>
                    </div>
                </a>
                ';
            }

        } else {
            echo "<p>No clients assigned yet.</p>";
        }

        ?>

    </div>

</div>

</body>
</html>