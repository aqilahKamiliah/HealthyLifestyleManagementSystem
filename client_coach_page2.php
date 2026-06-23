<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$coach_id = $_GET['coach_id'] ?? 0;
$user_id = $_SESSION['user_id'] ?? 0;

/* get client_id based on logged in user */
$clientSql = "SELECT client_id FROM client WHERE user_id = '$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$clientRow = mysqli_fetch_assoc($clientResult);
$client_id = $clientRow['client_id'] ?? 0;

/* insert evaluation */
if(isset($_POST['submit_evaluation']))
{
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];
    $date = date("Y-m-d");

    $insert = "INSERT INTO evaluation (feedback, date, rating, coach_id, client_id)
               VALUES ('$feedback', '$date', '$rating', '$coach_id', '$client_id')";

    if(mysqli_query($conn, $insert))
    {
        echo "<script>alert('Evaluation submitted successfully!');</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}

/* get coach details */
$sql = "SELECT coach.coach_id, coach.specialization, coach.experience_years, users.name
        FROM coach, users
        WHERE coach.user_id = users.user_id
        AND coach.coach_id = '$coach_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

/* get average rating */
$ratingSql = "SELECT AVG(rating) AS avg_rating FROM evaluation WHERE coach_id = '$coach_id'";
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
            <p>
                Remember to track your meals daily and
                stay hydrated throughout the day.
            </p>
        </div>
    </div>
    
    <div class="right-panel">
        <h2>Evaluation Progress</h2>

        <p>Average Rating: <?php echo number_format($avg_rating, 1); ?> / 5</p>

        <form action="client_coach_page2.php?coach_id=<?php echo $coach_id; ?>" method="POST">

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
    </div>

</div>

</body>
</html>