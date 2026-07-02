<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>

<?php
session_start();
include("connection.php");

/* ===============================
   GET USER NAME
================================*/
$user_name = "User";

if(isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT name FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['name'];
    }
}

/* ===============================
   LOGOUT
================================*/
if(isset($_POST['confirmButton']))
{
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<body>
    <?php include("headerCoach.php"); ?>

    <div class="logoutContainer">
    <div class="logoutHeader">
        <h2>Log Out Confirmation</h2>
    </div>

    <div class="logoutContent">
        <h3>Goodbye, <?php echo htmlspecialchars($user_name); ?>!</h3>

        <p>Thank you for update your log today.</p>

        <form method="POST">

        <div class="logoutOptions">

            <button type="button"
                    id="cancelButton"
                    onclick="window.location.href='coach_home.php'">
                Cancel & Remain Logged In
            </button>

            <button type="submit"
                    id="confirmButton"
                    name="confirmButton">
                Yes, Securely Log Out
            </button>

        </div>
        </form>

        <p class="center">Logging out will securely end your system session.</p>
        <p class="center">All data is saved. Redirecting to the System Homepage...</p>
    </div>
    </div>

</body>
</html>