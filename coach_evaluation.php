<?php
include 'connection.php';

$sql = "SELECT users.name, client.client_id
        FROM client
        INNER JOIN users
        ON client.user_id = users.user_id";

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

<div style="width:80%; margin:30px auto; display:flex; gap:20px; flex-wrap:wrap;">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:250px;">

        <h3><?php echo $row['name']; ?></h3>

        <p>Client ID: <?php echo $row['client_id']; ?></p>

        <form>

            <p>Rating:</p>

            <input type="radio"
                   name="rating_<?php echo $row['client_id']; ?>"
                   value="1"> ★ <br>

            <input type="radio"
                   name="rating_<?php echo $row['client_id']; ?>"
                   value="2"> ★★ <br>

            <input type="radio"
                   name="rating_<?php echo $row['client_id']; ?>"
                   value="3"> ★★★ <br>

            <input type="radio"
                   name="rating_<?php echo $row['client_id']; ?>"
                   value="4"> ★★★★ <br>

            <input type="radio"
                   name="rating_<?php echo $row['client_id']; ?>"
                   value="5"> ★★★★★

            <p>Comment</p>

            <textarea
                placeholder="Description"
                style="width:100%; height:60px;"></textarea>

            <br><br>

            <button type="submit"
                    style="background:#6a5acd; color:white; border:none; padding:8px 15px; border-radius:5px;">
                Submit
            </button>

        </form>

    </div>

<?php } ?>

</div>

</body>
</html>