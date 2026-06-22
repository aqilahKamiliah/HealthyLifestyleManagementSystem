<?php
include 'connection.php';

$sql = "SELECT users.name, coach.specialization, coach.experience_years
        FROM coach
        INNER JOIN users ON coach.user_id = users.user_id
        WHERE users.role = 'coach'
        LIMIT 1";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coach Profile</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

    <!-- PROFILE BOX -->
    <div style="border:1px solid #ccc; padding:20px; display:flex; justify-content:space-between; align-items:center;">
        
        <div>
            <h2 style="margin:0;">
                <?php echo $row['name']; ?>
            </h2>
            <small>Coach</small>
        </div>

        <button style="background:#6a5acd; color:white; border:none; padding:8px 15px; border-radius:5px;">
            Edit
        </button>

    </div>

    <!-- BIOMETRIC SNAPSHOT -->
    <div style="border:1px solid #ccc; margin-top:20px; padding:20px;">

        <h3>Biometric Snapshot</h3>

        <p>
            <strong>Full Name:</strong>
            <?php echo $row['name']; ?>
        </p>

        <p><strong>Specialization:</strong></p>

        <ul>
            <li><?php echo $row['specialization']; ?></li>
        </ul>

        <p>
            <strong>Experience Years:</strong>
            <?php echo $row['experience_years']; ?> Years
        </p>

    </div>

</div>

</body>
</html>