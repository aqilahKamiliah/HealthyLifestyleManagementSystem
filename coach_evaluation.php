<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['user_id']))
{
    die("Session expired. Please login again.");
}

$user_id = $_SESSION['user_id'];

/* Ambil coach_id */
$coachQuery = "SELECT coach_id
               FROM coach
               WHERE user_id='$user_id'";

$coachResult = mysqli_query($conn,$coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

/* Submit Evaluation */
if(isset($_POST['submit_evaluation']))
{
    $client_id = $_POST['client_id'];
    $session_id = $_POST['session_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $sessionQuery = "SELECT *
                     FROM coaching_session
                     WHERE session_id='$session_id'";

    $sessionResult = mysqli_query($conn,$sessionQuery);
    $session = mysqli_fetch_assoc($sessionResult);

    if(!$session)
    {
        echo "<script>
                alert('Session not found.');
                window.location='coach_evaluation.php';
              </script>";
        exit();
    }

    $today = date('Y-m-d');

    if($session['status'] != 'Expired' && $session['end_date'] > $today)
    {
        echo "<script>
                alert('Evaluation is only available after the coaching session ends.');
                window.location='coach_evaluation.php';
              </script>";
        exit();
    }

    $check = "SELECT *
              FROM evaluation
              WHERE session_id='$session_id'
              AND evaluator='Coach'";

    $checkResult = mysqli_query($conn,$check);

    if(mysqli_num_rows($checkResult) > 0)
    {
        echo "<script>
                alert('You have already evaluated this session.');
                window.location='coach_evaluation.php';
              </script>";
        exit();
    }

    $insert = "INSERT INTO evaluation
               (feedback,date,rating,coach_id,client_id,session_id,evaluator)
               VALUES
               ('$feedback',CURDATE(),'$rating','$coach_id','$client_id','$session_id','Coach')";

    if(mysqli_query($conn,$insert))
    {
        mysqli_query($conn,"
        UPDATE coaching_session
        SET coach_evaluated='1'
        WHERE session_id='$session_id'
        ");

        $completeQuery = mysqli_query($conn,"
        SELECT client_evaluated,
               coach_evaluated
        FROM coaching_session
        WHERE session_id='$session_id'
        ");

        $completeData = mysqli_fetch_assoc($completeQuery);

        if($completeData['client_evaluated']==1 &&
           $completeData['coach_evaluated']==1)
        {
            mysqli_query($conn,"
            UPDATE coaching_session
            SET status='Completed'
            WHERE session_id='$session_id'
            ");

            mysqli_query($conn,"
            UPDATE client
            SET coach_id=NULL
            WHERE client_id='$client_id'
            ");
        }

        echo "<script>
                alert('Evaluation submitted successfully!');
                window.location='coach_evaluation.php';
              </script>";
        exit();
    }
}

$sql = "SELECT cs.session_id,
               cs.start_date,
               cs.end_date,
               cs.duration_month,
               cs.status,
               cs.client_evaluated,
               cs.coach_evaluated,
               c.client_id,
               c.goal,
               u.name
        FROM coaching_session cs
        INNER JOIN client c
        ON cs.client_id=c.client_id
        INNER JOIN users u
        ON c.user_id=u.user_id
        WHERE cs.coach_id='$coach_id'
        ORDER BY cs.session_id DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Evaluation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="
    width:90%;
    margin:40px auto;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    gap:25px;
    flex-wrap:wrap;">

<?php
while($row = mysqli_fetch_assoc($result))
{
    $session_id = $row['session_id'];
    $client_id = $row['client_id'];

    $evaluationCheck = mysqli_query($conn,
    "SELECT *
     FROM evaluation
     WHERE session_id='$session_id'
     AND evaluator='Coach'");

    $alreadyEvaluated = mysqli_num_rows($evaluationCheck) > 0;

    $today = date('Y-m-d');

    if($row['status']=="Expired" || $row['end_date'] <= $today)
    {
        $sessionEnded = true;
    }
    else
    {
        $sessionEnded = false;
    }
?>

<div style="
    background:white;
    border:1px solid #ddd;
    border-radius:15px;
    padding:25px;
    width:300px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);">

    <h2 style="margin-top:0;">
        <?php echo $row['name']; ?>
    </h2>

    <p>
        <strong>Client ID:</strong>
        <?php echo $client_id; ?>
    </p>

    <p>
        <strong>Goal:</strong>
        <?php echo $row['goal']; ?>
    </p>

    <hr>

    <p>
        <strong>Duration:</strong>
        <?php echo $row['duration_month']; ?> Month(s)
    </p>

    <p>
        <strong>Start Date:</strong>
        <?php echo $row['start_date']; ?>
    </p>

    <p>
        <strong>End Date:</strong>
        <?php echo $row['end_date']; ?>
    </p>

    <p>
        <strong>Status:</strong>

        <?php
        if($row['status']=="Active")
        {
            echo "<span style='color:#1976d2;font-weight:bold;'>Active</span>";
        }
        elseif($row['status']=="Expired")
        {
            echo "<span style='color:#ff9800;font-weight:bold;'>Expired</span>";
        }
        else
        {
            echo "<span style='color:green;font-weight:bold;'>Completed</span>";
        }
        ?>

    </p>

    <hr>

<?php
if(!$sessionEnded)
{
?>

    <div style="
        background:#fff3cd;
        color:#856404;
        padding:15px;
        border-radius:10px;
        text-align:center;
        font-weight:bold;">

        Evaluation will be available after
        <br>
        <br>

        <?php echo $row['end_date']; ?>

    </div>

<?php
}
else
{
    if($alreadyEvaluated)
    {
?>

    <div style="
        background:#d4edda;
        color:#155724;
        padding:15px;
        border-radius:10px;
        text-align:center;
        font-weight:bold;">

        ✔ Evaluation Submitted

    </div>

<?php
    }
    else
    {
?>

<form method="POST">

    <input type="hidden"
           name="client_id"
           value="<?php echo $client_id; ?>">

    <input type="hidden"
           name="session_id"
           value="<?php echo $session_id; ?>">

    <p style="font-weight:bold;">
        Rating
    </p>

    <label>
        <input type="radio"
               name="rating"
               value="1"
               required>
        ⭐
    </label>
    <br>

    <label>
        <input type="radio"
               name="rating"
               value="2">
        ⭐⭐
    </label>
    <br>

    <label>
        <input type="radio"
               name="rating"
               value="3">
        ⭐⭐⭐
    </label>
    <br>

    <label>
        <input type="radio"
               name="rating"
               value="4">
        ⭐⭐⭐⭐
    </label>
    <br>

    <label>
        <input type="radio"
               name="rating"
               value="5">
        ⭐⭐⭐⭐⭐
    </label>

    <br><br>

    <textarea
        name="feedback"
        placeholder="Write your feedback..."
        required
        style="
        width:100%;
        height:90px;
        padding:10px;
        border:1px solid #ccc;
        border-radius:8px;
        resize:none;
        box-sizing:border-box;"></textarea>

    <br><br>

    <button
        type="submit"
        name="submit_evaluation"
        style="
        background:#6a5acd;
        color:white;
        border:none;
        padding:10px 25px;
        border-radius:8px;
        cursor:pointer;
        font-weight:bold;">

        Submit Evaluation

    </button>

</form>

<?php
    }
}
?>

</div>

<?php
}
?>

</div>

</body>
</html>