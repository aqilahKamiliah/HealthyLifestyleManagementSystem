<?php
session_start();
include 'connection.php';
include 'headerClient.php';

$user_id = $_SESSION['user_id'] ?? 0;

$clientSql = "SELECT client_id, coach_id FROM client WHERE user_id = '$user_id'";
$clientResult = mysqli_query($conn, $clientSql);
$clientData = mysqli_fetch_assoc($clientResult);

$client_id = $clientData['client_id'] ?? 0;
$current_coach_id = $clientData['coach_id'] ?? 0;

if($client_id == 0)
{
    echo "<script>
            alert('Please complete your biodata first.');
            window.location.href='client_bio.php';
          </script>";
    exit();
}

if($current_coach_id != 0)
{
    header("Location: client_coach_page2.php");
    exit();
}

if(isset($_GET['coach_id']))
{
    $selected_coach_id = $_GET['coach_id'];

    $update = "UPDATE client 
               SET coach_id = '$selected_coach_id'
               WHERE client_id = '$client_id'";

    if(mysqli_query($conn, $update))
    {
        header("Location: client_coach_page2.php");
        exit();
    }
}

$sql = "SELECT coach.coach_id, coach.specialization, coach.experience_years, users.name
        FROM coach, users
        WHERE coach.user_id = users.user_id
        AND users.role = 'coach'";

$result = mysqli_query($conn, $sql);
?>

<h2 class="coach-title">Choose a coach that fits your goals</h2>

<div class="coach-container">

<?php
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>
        <div class="coach-card">
            <div class="avatar"></div>

            <h3><?php echo $row['name']; ?></h3>

            <p>
                Specialization: <?php echo $row['specialization']; ?><br>
                Experience: <?php echo $row['experience_years']; ?> years
            </p>

            <a href="client_coach_page1.php?coach_id=<?php echo $row['coach_id']; ?>">
                <button>Choose Coach</button>
            </a>
        </div>
<?php
    }
}
else
{
    echo "<p>No coach available.</p>";
}
?>

</div>

</body>
</html>