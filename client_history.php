<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

$clientSql = "SELECT client_id FROM client WHERE user_id = '$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$clientData = mysqli_fetch_assoc($clientResult);

$client_id = $clientData['client_id'] ?? 0;

$progressSql = "SELECT * FROM progress 
                WHERE client_id = '$client_id'
                ORDER BY date DESC";
$progressResult = mysqli_query($conn, $progressSql);

$foodSql = "SELECT * FROM food_logs
            WHERE client_id = '$client_id'
            ORDER BY date DESC";
$foodResult = mysqli_query($conn, $foodSql);

$avgCalorieSql = "SELECT AVG(calorie) AS avg_calorie 
                  FROM food_logs 
                  WHERE client_id = '$client_id'";
$avgCalorieResult = mysqli_query($conn, $avgCalorieSql);
$avgCalorieData = mysqli_fetch_assoc($avgCalorieResult);
$avg_calorie = $avgCalorieData['avg_calorie'] ?? 0;

$logCountSql = "SELECT COUNT(*) AS total_log 
                FROM food_logs 
                WHERE client_id = '$client_id'";
$logCountResult = mysqli_query($conn, $logCountSql);
$logCountData = mysqli_fetch_assoc($logCountResult);
$total_log = $logCountData['total_log'] ?? 0;
?>

<div class="history-container">
    <div class="stats">

        <div class="card">
            <h2>Weight Trend</h2>
            <div class="chart">
                <?php
                $trendSql = "SELECT * FROM progress 
                             WHERE client_id = '$client_id'
                             ORDER BY date ASC";

                $trendResult = mysqli_query($conn, $trendSql);

                if(mysqli_num_rows($trendResult) > 0)
                {
                    while($row = mysqli_fetch_assoc($trendResult))
                    {
                        echo $row['date'] . " : " . $row['weight'] . " kg<br>";
                    }
                }
                else
                {
                    echo "No weight data available.";
                }
                ?>
            </div>
        </div>

        <div class="card">
            <h2>AVG Calorie Intake</h2>
            <div class="chart">
                <?php echo round($avg_calorie, 2); ?> kcal
            </div>
        </div>

        <div class="card">
            <h2>Food Log Summary</h2>
            <div class="chart">
                <?php
                $foodSummarySql = "SELECT * FROM food_logs
                                   WHERE client_id = '$client_id'
                                   ORDER BY date DESC
                                   LIMIT 5";

                $foodSummaryResult = mysqli_query($conn, $foodSummarySql);

                if(mysqli_num_rows($foodSummaryResult) > 0)
                {
                    while($food = mysqli_fetch_assoc($foodSummaryResult))
                    {
                        echo $food['date'] . " - " . $food['meal_type'] . "<br>";
                        echo $food['food_names'] . " (" . $food['calorie'] . " kcal)<br><br>";
                    }
                }
                else
                {
                    echo "No food log available.";
                }
                ?>
            </div>
        </div>

        <div class="card">
            <h2>Goal Consistency</h2>
            <div class="circle">
                <?php echo $total_log; ?>
            </div>
            <p>Total Food Logs Recorded</p>
        </div>

    </div>

    <div class="table-section">
        <div class="table-title">
            Detailed Progress History
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Weight</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if(mysqli_num_rows($progressResult) > 0)
                {
                    while($row = mysqli_fetch_assoc($progressResult))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['weight'] . " kg</td>";
                        echo "</tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='2'>No progress record found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <br><br>

    <div class="table-section">
        <div class="table-title">
            Food Log History
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Meal Type</th>
                    <th>Food Name</th>
                    <th>Calorie</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if(mysqli_num_rows($foodResult) > 0)
                {
                    while($row = mysqli_fetch_assoc($foodResult))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['meal_type'] . "</td>";
                        echo "<td>" . $row['food_names'] . "</td>";
                        echo "<td>" . $row['calorie'] . " kcal</td>";
                        echo "</tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='4'>No food log record found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>