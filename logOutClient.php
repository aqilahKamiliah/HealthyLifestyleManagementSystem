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

if(isset($_POST['confirmButton']))
{
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<body>
    <?php
        include("headerClient.php");
    ?>
    <div class="logoutContainer">
    <div class="logoutHeader">
        <h2>Log Out Confirmation</h2>
    </div>

    <div class="logoutContent">
    <h3>Goodbye!</h3>
    <p>Thank you for managing the system today.</p>

    <form method="POST">

    <div class="logoutOptions">

        <button type="button"
                id="cancelButton"
                onclick="window.location.href='client_home.php'">
            Cancel & Remain Logged In
        </button>

        <button type="submit"
                id="confirmButton"
                name="confirmButton">
            Yes, Securely Log Out
        </button>

    </div>
    </div>

    </form>

    <p class="center">Logging out will securely end your system session.</p>
    <p class="center">All data is saved. Redirecting to the System Homepage...</p>
    </div>
</body>
</html>