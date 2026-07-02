<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

// Get Client ID
$clientSql = "SELECT client_id
              FROM client
              WHERE user_id = '$user_id'";

$clientResult = mysqli_query($conn, $clientSql);
$clientData = mysqli_fetch_assoc($clientResult);

$client_id = $clientData['client_id'] ?? 0;

if($client_id == 0)
{
    echo "<script>
            alert('Please complete your biodata first.');
            window.location.href='client_bio.php';
          </script>";
    exit();
}

// Check if client already has an ACTIVE coaching session
$sessionSql = "SELECT *
               FROM coaching_session
               WHERE client_id = '$client_id'
               AND status = 'Active'
               LIMIT 1";

$sessionResult = mysqli_query($conn, $sessionSql);

if(mysqli_num_rows($sessionResult) > 0)
{
    header("Location: client_coach_page2.php");
    exit();
}

// Display all coaches
$sql = "SELECT coach.coach_id,
               coach.specialization,
               coach.experience_years,
               users.name
        FROM coach
        JOIN users
        ON coach.user_id = users.user_id
        ORDER BY users.name";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>

<style>

.coach-title{
    text-align:center;
    margin:30px 0;
}

.coach-container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:25px;
}

.coach-card{
    width:280px;
    background:#fff;
    border-radius:10px;
    padding:20px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,.15);
}

.avatar{
    width:90px;
    height:90px;
    background:#ddd;
    border-radius:50%;
    margin:auto;
    margin-bottom:15px;
}

.coach-card button{

    width:100%;
    padding:10px;
    background:#50B848;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:15px;

}

.coach-card button:hover{

    background:#41963b;

}

</style>

</head>

<body>

<h2 class="coach-title">
Choose a Coach
</h2>

<div class="coach-container">

<?php

if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
?>

<div class="coach-card">

    <div class="avatar"></div>

    <h3><?php echo $row['name']; ?></h3>

    <p>

    <b>Specialization</b><br>

    <?php echo $row['specialization']; ?>

    </p>

    <p>

    <b>Experience</b><br>

    <?php echo $row['experience_years']; ?> Years

    </p>

    <a href="choose_duration.php?coach_id=<?php echo $row['coach_id']; ?>">

        <button>

        Choose Coach

        </button>

    </a>

</div>

<?php

    }
}
else
{

    echo "<h3>No coach available.</h3>";

}

?>

</div>

</body>
</html>