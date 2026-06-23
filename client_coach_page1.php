<?php
include 'connection.php';
include 'headerClient.php';

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

            <a href="client_coach_page2.php?coach_id=<?php echo $row['coach_id']; ?>">
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