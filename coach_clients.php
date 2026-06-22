<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

<?php
if(isset($_GET['name'])) {

    $name = $_GET['name'];
?>

    <h2><?php echo $name; ?></h2>

    <div style="display:flex; justify-content:center; gap:30px; margin-top:30px;">

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Breakfast</h3>
            <p>Food Name: Oatmeal</p>
            <p>Calories: 300 kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Lunch</h3>
            <p>Food Name: Chicken Rice</p>
            <p>Calories: 600 kcal</p>
        </div>

        <div style="border:1px solid #ccc; padding:20px; border-radius:10px;">
            <h3>Dinner</h3>
            <p>Food Name: Salad</p>
            <p>Calories: 400 kcal</p>
        </div>

    </div>

    <br>
    <a href="coach_clients.php">← Back</a>

<?php
} else {

    $sql = "SELECT users.name, client.client_id
            FROM client
            INNER JOIN users
            ON client.user_id = users.user_id";

    $result = mysqli_query($conn, $sql);

    echo '<div style="display:flex; gap:20px; flex-wrap:wrap;">';

    while($row = mysqli_fetch_assoc($result)) {
?>

        <a href="coach_clients.php?name=<?php echo $row['name']; ?>"
           style="text-decoration:none; color:black;">

            <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:200px; cursor:pointer;">

                <h3><?php echo $row['name']; ?></h3>

                <p>Client ID: <?php echo $row['client_id']; ?></p>

            </div>

        </a>

<?php
    }

    echo '</div>';
}
?>

</div>

</body>
</html>