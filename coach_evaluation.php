<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];

/* Ambil coach_id */
$coachQuery = "SELECT coach_id
               FROM coach
               WHERE user_id = '$user_id'";

$coachResult = mysqli_query($conn, $coachQuery);
$coachData = mysqli_fetch_assoc($coachResult);

$coach_id = $coachData['coach_id'];

/* Simpan Evaluation */
if(isset($_POST['submit_evaluation']))
{
    $client_id = $_POST['client_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $check = "SELECT *
              FROM evaluation
              WHERE coach_id = '$coach_id'
              AND client_id = '$client_id'";

    $checkResult = mysqli_query($conn, $check);

    if(mysqli_num_rows($checkResult) > 0)
    {
        echo "
        <script>
            alert('You have already evaluated this client.');
            window.location='evaluation.php';
        </script>
        ";
    }
    else
    {
        $insert = "INSERT INTO evaluation
                   (feedback, date, rating, coach_id, client_id)
                   VALUES
                   ('$feedback', CURDATE(), '$rating', '$coach_id', '$client_id')";

        if(mysqli_query($conn, $insert))
        {
            echo "
            <script>
                alert('Evaluation submitted successfully!');
                window.location='evaluation.php';
            </script>
            ";
        }
    }
}

/* Ambil client bawah coach */
$sql = "SELECT users.name,
               client.client_id,
               client.goal
        FROM client
        INNER JOIN users
        ON client.user_id = users.user_id
        WHERE client.coach_id = '$coach_id'";

$result = mysqli_query($conn, $sql);
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

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<?php

$client_id = $row['client_id'];

$evaluationCheck = mysqli_query(
    $conn,
    "SELECT *
     FROM evaluation
     WHERE coach_id = '$coach_id'
     AND client_id = '$client_id'"
);

$alreadyEvaluated = mysqli_num_rows($evaluationCheck) > 0;

?>

    <div style="
        background:white;
        border:1px solid #ddd;
        border-radius:15px;
        padding:25px;
        width:300px;
        align-self:flex-start;
        box-shadow:0 3px 10px rgba(0,0,0,0.1);">

        <h2 style="
            margin-top:0;
            margin-bottom:15px;
            color:#333;">
            <?php echo $row['name']; ?>
        </h2>

        <p>
            <strong>Client ID:</strong>
            <?php echo $row['client_id']; ?>
        </p>

        <p>
            <strong>Goal:</strong>
            <?php echo $row['goal']; ?>
        </p>

        <?php if(!$alreadyEvaluated) { ?>

        <form method="POST">

            <input type="hidden"
                   name="client_id"
                   value="<?php echo $row['client_id']; ?>">

            <p style="
                font-weight:bold;
                margin-top:20px;">
                Rating:
            </p>

            <label>
                <input type="radio" name="rating" value="1" required>
                ⭐
            </label>
            <br>

            <label>
                <input type="radio" name="rating" value="2">
                ⭐⭐
            </label>
            <br>

            <label>
                <input type="radio" name="rating" value="3">
                ⭐⭐⭐
            </label>
            <br>

            <label>
                <input type="radio" name="rating" value="4">
                ⭐⭐⭐⭐
            </label>
            <br>

            <label>
                <input type="radio" name="rating" value="5">
                ⭐⭐⭐⭐⭐
            </label>

            <p style="
                font-weight:bold;
                margin-top:20px;">
                Comment
            </p>

            <textarea
                name="feedback"
                placeholder="Write your comments..."
                style="
                    width:100%;
                    height:90px;
                    padding:10px;
                    border:1px solid #ccc;
                    border-radius:8px;
                    resize:none;
                    box-sizing:border-box;"
                required></textarea>

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

                Submit

            </button>

        </form>

        <?php } else { ?>

            <div style="
                background:#e8f5e9;
                color:#2e7d32;
                padding:15px;
                border-radius:10px;
                text-align:center;
                font-weight:bold;
                margin-top:15px;
                border:1px solid #c8e6c9;">

                ✔ Evaluation Submitted

            </div>

        <?php } ?>

    </div>

<?php } ?>

</div>

</body>
</html>