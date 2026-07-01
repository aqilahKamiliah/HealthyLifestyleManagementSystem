<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;


$clientSql = "SELECT client_id, coach_id FROM client WHERE user_id = '$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$clientRow = mysqli_fetch_assoc($clientResult);

$client_id = $clientRow['client_id'] ?? 0;
$coach_id = $clientRow['coach_id'] ?? 0;

if($coach_id == 0)
{
    header("Location: client_coach_page1.php");
    exit();
}


$checkEvalSql = "SELECT * FROM evaluation 
                 WHERE client_id = '$client_id' 
                 AND coach_id = '$coach_id'
                 LIMIT 1";
$checkEvalResult = mysqli_query($conn, $checkEvalSql);
$existingEval = mysqli_fetch_assoc($checkEvalResult);


if(isset($_POST['submit_evaluation']) && !$existingEval)
{
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $date = date("Y-m-d");

    $insert = "INSERT INTO evaluation (feedback, date, rating, coach_id, client_id)
               VALUES ('$feedback', '$date', '$rating', '$coach_id', '$client_id')";

    if(mysqli_query($conn, $insert))
    {
        echo "<script>alert('Evaluation submitted successfully!'); window.location='client_coach_page2.php';</script>";
        exit();
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}


$sql = "SELECT coach.coach_id, coach.specialization, coach.experience_years, users.name
        FROM coach, users
        WHERE coach.user_id = users.user_id
        AND coach.coach_id = '$coach_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$ratingSql = "SELECT AVG(rating) AS avg_rating 
              FROM evaluation 
              WHERE coach_id = '$coach_id'";
$ratingResult = mysqli_query($conn, $ratingSql);
$ratingRow = mysqli_fetch_assoc($ratingResult);
$avg_rating = $ratingRow['avg_rating'] ?? 0;
?>

<div class="container">

    <div class="left-panel">
        <h2>My Coach</h2>

        <div class="coach-profile">
            <div class="avatar"></div>

            <?php
            if($row)
            {
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>Specialization: " . $row['specialization'] . "</p>";
                echo "<p>Experience: " . $row['experience_years'] . " years</p>";
            }
            else
            {
                echo "<h3>No Coach Selected</h3>";
                echo "<p>Coach information unavailable.</p>";
            }
            ?>
        </div>

        <div class="reminder-box">
            <h2>Reminder Messages</h2>

            <?php
            $historySql = "SELECT * FROM history
                           WHERE client_id = '$client_id'
                           ORDER BY history_date DESC
                           LIMIT 3";

            $historyResult = mysqli_query($conn, $historySql);

            if(mysqli_num_rows($historyResult) > 0)
            {
                while($history = mysqli_fetch_assoc($historyResult))
                {
                    echo "<p>";
                    echo "<b>" . date('Y-m-d', strtotime($history['history_date'])) . "</b><br>";
                    echo $history['message'];
                    echo "</p>";
                }
            }
            else
            {
                echo "<p>No reminder message available.</p>";
            }
            ?>
        </div>
    </div>

    <div class="right-panel">
        <h2>Evaluation Progress</h2>

        <p>Average Rating: <?php echo number_format($avg_rating, 1); ?> / 5</p>

        <?php
        if($existingEval)
        {
        ?>
            <p style="color: green; font-weight: bold;">
                You have already submitted your evaluation for this coach.
            </p>

            <div class="reminder-box">
                <h3>Your Evaluation</h3>
                <p><b>Rating:</b> <?php echo $existingEval['rating']; ?> / 5</p>
                <p><b>Feedback:</b> <?php echo $existingEval['feedback']; ?></p>
                <p><b>Date:</b> <?php echo $existingEval['date']; ?></p>
            </div>
        <?php
        }
        else
        {
        ?>
            <form action="client_coach_page2.php" method="POST">

                <h3>Rate Your Coach</h3>
                <select name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>

                <h3>Challenges Faced / Feedback</h3>
                <textarea name="feedback" rows="5" required></textarea>
                <br><br>

                <button type="submit" name="submit_evaluation">Submit</button>

            </form>
        <?php
        }
        ?>
    </div>

</div>

</body>
</html>