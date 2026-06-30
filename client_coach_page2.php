<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id == 0) {
    header("Location: index.php");
    exit();
}

/* Get client info */
$clientSql = "SELECT client_id, coach_id FROM client WHERE user_id = '$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$clientData = mysqli_fetch_assoc($clientResult);

$client_id = $clientData['client_id'] ?? 0;
$coach_id = $clientData['coach_id'] ?? 0;

if ($client_id == 0) {
    header("Location: client_bio.php");
    exit();
}

if ($coach_id == 0) {
    header("Location: client_coach_page1.php");
    exit();
}

/* Check if already evaluated */
$checkEvalSql = "SELECT * FROM evaluation 
                 WHERE client_id = '$client_id' 
                 AND coach_id = '$coach_id'";
$checkEvalResult = mysqli_query($conn, $checkEvalSql);
$alreadyRated = mysqli_num_rows($checkEvalResult) > 0;

$myRating = "";
$myFeedback = "";
$myDate = "";

if($alreadyRated)
{
    $evalData = mysqli_fetch_assoc($checkEvalResult);
    $myRating = $evalData['rating'];
    $myFeedback = $evalData['feedback'];
    $myDate = $evalData['date'];
}

/* Insert evaluation */
if (isset($_POST['submit_evaluation'])) {
    $rating = $_POST['rating'];
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    $date = date("Y-m-d");

    if ($alreadyRated) {
        echo "<script>
                alert('You have already submitted an evaluation for this coach.');
                window.location='client_coach_page2.php';
              </script>";
        exit();
    }
    else {
        $insert = "INSERT INTO evaluation (feedback, date, rating, coach_id, client_id)
                   VALUES ('$feedback', '$date', '$rating', '$coach_id', '$client_id')";

        if (mysqli_query($conn, $insert)) {
            echo "<script>
                    alert('Evaluation submitted successfully!');
                    window.location='client_coach_page2.php';
                  </script>";
            exit();
        } 
        else {
            echo "Error inserting evaluation: " . mysqli_error($conn);
        }
    }
}

/* Get selected coach details */
$sql = "SELECT coach.coach_id, coach.specialization, coach.experience_years, users.name
        FROM coach
        JOIN users ON coach.user_id = users.user_id
        WHERE coach.coach_id = '$coach_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

/* Get average rating */
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
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>Specialization: " . htmlspecialchars($row['specialization']) . "</p>";
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

        <?php
        if($alreadyRated)
        {
            echo "<p style='color: green; font-weight: bold;'>
                    You have already submitted your evaluation for this coach.
                  </p>";

            echo "<div style='margin-top: 20px; padding: 15px; background-color: #e8f5e9; border-radius: 8px;'>
                    <h3>Your Evaluation</h3>
                    <p><b>Rating:</b> " . $myRating . " / 5</p>
                    <p><b>Feedback:</b> " . htmlspecialchars($myFeedback) . "</p>
                    <p><b>Date:</b> " . $myDate . "</p>
                  </div>";
        }
        else
        {
        ?>
            <form action="" method="POST">
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