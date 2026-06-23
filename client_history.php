<?php
include 'connection.php';
include 'headerClient.php';

$sql = "SELECT * FROM progress ORDER BY date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="history-container">
    <div class="stats">

        <div class="card">
            <h2>Weight Trend</h2>
            <div class="chart">
                <?php
                $trendSql = "SELECT * FROM progress ORDER BY date ASC";
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
                    <th>Client ID</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['weight'] . " kg</td>";
                        echo "<td>" . $row['client_id'] . "</td>";
                        echo "</tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='3'>No progress record found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>