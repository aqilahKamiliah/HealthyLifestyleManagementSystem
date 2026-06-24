<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT users.name,
                 users.email,
                 coach.specialization,
                 coach.experience_years
          FROM users
          INNER JOIN coach
          ON users.user_id = coach.user_id
          WHERE users.user_id = '$user_id'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $experience = (int)$_POST['experience'];

    $updateUser = "UPDATE users
                   SET name = '$name'
                   WHERE user_id = '$user_id'";

    $updateCoach = "UPDATE coach
                    SET specialization = '$specialization',
                        experience_years = '$experience'
                    WHERE user_id = '$user_id'";

    $userUpdated = mysqli_query($conn, $updateUser);
    $coachUpdated = mysqli_query($conn, $updateCoach);

    if ($userUpdated && $coachUpdated) {
        echo "<script>
                alert('Profile updated successfully!');
                window.location.href='coach_profile.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Failed to update profile!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Coach Profile</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

    <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">

        <h2>Edit Coach Profile</h2>

        <form method="POST">

            <p><strong>Full Name</strong></p>
            <input
                type="text"
                name="name"
                value="<?php echo htmlspecialchars($data['name']); ?>"
                required
                style="width:300px; padding:8px;">

            <br><br>

            <p><strong>Email</strong></p>
            <input
                type="text"
                value="<?php echo htmlspecialchars($data['email']); ?>"
                disabled
                style="width:300px; padding:8px; background:#eee;">

            <br><br>

            <p><strong>Specialization</strong></p>
            <input
                type="text"
                name="specialization"
                value="<?php echo htmlspecialchars($data['specialization']); ?>"
                required
                style="width:300px; padding:8px;">

            <br><br>

            <p><strong>Experience Years</strong></p>
            <input
                type="number"
                name="experience"
                value="<?php echo htmlspecialchars($data['experience_years']); ?>"
                required
                style="width:300px; padding:8px;">

            <br><br>

            <button
                type="submit"
                name="update"
                style="background:#6a5acd; color:white; border:none; padding:10px 20px; border-radius:5px;">
                Update
            </button>

            <a href="coach_profile.php">
                <button
                    type="button"
                    style="background:gray; color:white; border:none; padding:10px 20px; border-radius:5px;">
                    Cancel
                </button>
            </a>

        </form>

    </div>

</div>

</body>
</html>