<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

// Get Client ID
$clientSql = "SELECT Client_id
              FROM Client
              WHERE user_id='$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$client = mysqli_fetch_assoc($clientResult);

$client_id = $client['Client_id'] ?? 0;

if($client_id == 0)
{
    header("Location: client_bio.php");
    exit();
}

// Check if client already has an active session
$checkSession = mysqli_query($conn,"
SELECT *
FROM coaching_session
WHERE client_id='$client_id'
AND status='Active'
LIMIT 1
");

if(mysqli_num_rows($checkSession) > 0)
{
    header("Location: client_coach_page2.php");
    exit();
}

// Get selected coach
$coach_id = $_GET['coach_id'] ?? $_POST['coach_id'] ?? 0;

if($coach_id == 0)
{
    header("Location: client_coach_page1.php");
    exit();
}

// Coach information
$coachSql = "SELECT users.name,
                    coach.specialization,
                    coach.experience_years
             FROM coach
             JOIN users
             ON coach.user_id = users.user_id
             WHERE coach.coach_id='$coach_id'";

$coachResult = mysqli_query($conn,$coachSql);
$coach = mysqli_fetch_assoc($coachResult);

// Start Session
if(isset($_POST['start_session']))
{
    $duration = $_POST['duration'];

    $start_date = date("Y-m-d");
    $end_date = date("Y-m-d", strtotime("+$duration month"));

    $insert = "INSERT INTO coaching_session
    (
        client_id,
        coach_id,
        start_date,
        end_date,
        duration_month,
        status
    )
    VALUES
    (
        '$client_id',
        '$coach_id',
        '$start_date',
        '$end_date',
        '$duration',
        'Active'
    )";

    if(mysqli_query($conn,$insert))
{
    $updateClientCoach = "UPDATE client
                          SET coach_id = '$coach_id'
                          WHERE Client_id = '$client_id'";

   if(!mysqli_query($conn, $updateClientCoach))
    {
        die("Update coach error: " . mysqli_error($conn));
    }

    echo "<script>
    alert('Coaching session started successfully!');
    window.location='client_profile.php';
    </script>";
    exit();
}
    else
    {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<style>

.container{

    width:500px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.15);

}

.avatar{

    width:90px;
    height:90px;
    background:#ddd;
    border-radius:50%;
    margin:auto;

}

h2,h3{

    text-align:center;

}

.info{

    margin:25px 0;
    line-height:30px;

}

.duration{

    margin:30px 0;

}

.duration label{

    display:block;
    padding:10px;

}

button{

    width:100%;
    padding:12px;
    border:none;
    background:#50B848;
    color:white;
    font-size:16px;
    border-radius:6px;
    cursor:pointer;

}

button:hover{

    background:#3d9338;

}

</style>

</head>

<body>

<div class="container">

<div class="avatar"></div>

<h2>

<?php echo $coach['name']; ?>

</h2>

<div class="info">

<b>Specialization</b>

<br>

<?php echo $coach['specialization']; ?>

<br><br>

<b>Experience</b>

<br>

<?php echo $coach['experience_years']; ?> Years

</div>

<form method="POST">

<input type="hidden"
name="coach_id"
value="<?php echo $coach_id; ?>">

<h3>

Choose Coaching Duration

</h3>

<div class="duration">

<label>

<input type="radio"
name="duration"
value="1"
required>

1 Month

</label>

<label>

<input type="radio"
name="duration"
value="3">

3 Months

</label>

<label>

<input type="radio"
name="duration"
value="6">

6 Months

</label>

</div>

<button
type="submit"
name="start_session">

Start Coaching

</button>

</form>

</div>

</body>
</html>