<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

// Get Client ID
$clientSql = "SELECT client_id
              FROM client
              WHERE user_id='$user_id'";

$clientResult = mysqli_query($conn,$clientSql);
$client = mysqli_fetch_assoc($clientResult);

$client_id = $client['client_id'] ?? 0;

if($client_id == 0)
{
    header("Location: client_bio.php");
    exit();
}

// Get ACTIVE coaching session
$sessionSql = "SELECT cs.*,
                      u.name,
                      c.specialization,
                      c.experience_years
               FROM coaching_session cs
               JOIN coach c
               ON cs.coach_id = c.coach_id
               JOIN users u
               ON c.user_id = u.user_id
               WHERE cs.client_id='$client_id'
               AND cs.status='Active'
               LIMIT 1";

$sessionResult = mysqli_query($conn,$sessionSql);

if(mysqli_num_rows($sessionResult)==0)
{
    header("Location: client_coach_page1.php");
    exit();
}

$session = mysqli_fetch_assoc($sessionResult);

$session_id = $session['session_id'];
$coach_id = $session['coach_id'];

$today = date("Y-m-d");

$remaining_days = floor(
(strtotime($session['end_date'])-strtotime($today))/86400
);

if($remaining_days < 0)
{
    $remaining_days = 0;
}

// Average Rating
$ratingSql = "SELECT AVG(rating) AS avg_rating
              FROM evaluation
              WHERE coach_id='$coach_id'";

$ratingResult = mysqli_query($conn,$ratingSql);
$ratingRow = mysqli_fetch_assoc($ratingResult);

$avg_rating = $ratingRow['avg_rating'] ?? 0;


// Client Evaluation
$checkEvalSql = "SELECT *
                 FROM evaluation
                 WHERE session_id='$session_id'
                 AND evaluator='Client'
                 LIMIT 1";

$checkEvalResult = mysqli_query($conn,$checkEvalSql);

$existingEval = mysqli_fetch_assoc($checkEvalResult);


// Submit Evaluation
if(isset($_POST['submit_evaluation']) && !$existingEval)
{

    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $date = date("Y-m-d");

    $insert = "INSERT INTO evaluation
    (
        feedback,
        date,
        rating,
        coach_id,
        client_id,
        session_id,
        evaluator
    )
    VALUES
    (
        '$feedback',
        '$date',
        '$rating',
        '$coach_id',
        '$client_id',
        '$session_id',
        'Client'
    )";

    if(mysqli_query($conn,$insert))
    {

        mysqli_query($conn,"
        UPDATE coaching_session
        SET client_evaluated=1
        WHERE session_id='$session_id'
        ");

        echo "<script>
        alert('Evaluation submitted successfully!');
        window.location='client_coach_page2.php';
        </script>";

        exit();

    }

}
?>

<div class="container">
<div class="left-panel">
<h2>My Coach</h2>
<div class="coach-profile">
<div class="avatar"></div>
<h3>

    <?php echo $session['name']; ?>

</h3>

<p>
    Specialization :
    <?php echo $session['specialization']; ?>
</p>

<p>
    Experience :
    <?php echo $session['experience_years']; ?>
    Years
</p>

</div>

<div class="reminder-box">
    <h2>Coaching Session</h2>
    <p><b>Start Date</b><br>
        <?php echo $session['start_date']; ?>
    </p>

    <p><b>End Date</b><br>
        <?php echo $session['end_date']; ?>
    </p>

    <p><b>Duration</b><br>
        <?php echo $session['duration_month']; ?> Month(s)
    </p>

    <p><b>Remaining</b><br>
        <?php echo $remaining_days; ?>Day(s)
    </p>
</div>


<div class="reminder-box">

    <h2>Reminder Messages</h2>

    <?php
    $historySql="SELECT *
    FROM history
    WHERE client_id='$client_id'
    ORDER BY history_date DESC
    LIMIT 3";

    $historyResult=mysqli_query($conn,$historySql);

    if(mysqli_num_rows($historyResult)>0)
    {
        while($history=mysqli_fetch_assoc($historyResult))
        {
            echo "<p>";
            echo "<b>";
            echo date('Y-m-d',strtotime($history['history_date']));
            echo "</b><br>";
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
        <h2>Coaching Progress</h2>
        <p>Average Coach Rating :<b><?php echo number_format($avg_rating,1); ?></b>/ 5</p><hr><br>

        <?php
            // Session still active
            if($today < $session['end_date'])
            {
        ?>

        <div class="reminder-box">
            <h3>Session Status</h3>
            <p style="color:green;font-weight:bold;">Your coaching session is currently active.</p>

            <p>The evaluation form will become available after your session ends.</p>

            <p><b>End Date :</b>
                <?php echo $session['end_date']; ?>
            </p>

            <p><b>Remaining :</b>
                <?php echo $remaining_days; ?>
                Day(s)
            </p>
        </div>

            <?php
                }
                // Session finished
                else
                {
                if($existingEval)
                {
            ?>

            <div class="reminder-box">
                <h3 style="color:green;">Evaluation Submitted</h3>
                <p>Thank you for completing your evaluation.</p><hr>

                <p><b>Rating</b><br>
                    <?php echo $existingEval['rating']; ?>/5
                </p>

                <p><b>Feedback</b>                <br>
                    <?php echo $existingEval['feedback']; ?>
                </p>

                <p><b>Date</b><br>
                    <?php echo $existingEval['date']; ?>
                </p>
            </div>

        <?php
        }
        else
        {
        ?>

        <form method="POST">
            <h3>Session Completed</h3>

            <p>Please evaluate your coach before ending this coaching session.</p><br>

            <label>Rating</label>

            <select
                name="rating"
                required>
                <option value="">Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>

            <br><br>
            <label>Feedback</label>

            <textarea name="feedback" rows="6" required></textarea>

            <br><br>

            <button type="submit" name="submit_evaluation">Submit Evaluation</button>
        </form>

        <?php
                }
            }
        ?>
    </div>

</div>

</body>
</html>