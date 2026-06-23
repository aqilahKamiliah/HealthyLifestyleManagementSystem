<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>
<body>
<?php 
include("headerAdmin.php");
include("connection.php");
?>

<div class="page-header">
    <h3>All Clients</h3>
</div>

<?php
// SQL query joining users and client tables to show all registered clients
$sql = "SELECT u.user_id, u.name, u.email, c.goal, c.age, c.gender, c.height, c.weight 
        FROM users u 
        INNER JOIN client c ON u.user_id = c.user_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

# Create table with expanded headings to show more data from the database
echo "<center><table border='1' cellspacing='1' cellpadding='5' width='90%'>";
echo "<tr style='background: #f5f5f5'>
        <th><center>User ID</th>
        <th><center>Name</th>
        <th><center>Email</th>
        <th><center>Age</th>
        <th><center>Gender</th>
        <th><center>Height (cm)</th>
        <th><center>Weight (kg)</th>
        <th><center>Goal</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td align='center'>" . htmlspecialchars($row['user_id']) . "</td>
            <td align='center'>" . htmlspecialchars($row['name']) . "</td>
            <td align='center'>" . htmlspecialchars($row['email']) . "</td>
            <td align='center'>" . htmlspecialchars($row['age']) . "</td>
            <td align='center'>" . htmlspecialchars($row['gender']) . "</td>
            <td align='center'>" . htmlspecialchars($row['height']) . "</td>
            <td align='center'>" . htmlspecialchars($row['weight']) . "</td>
            <td align='center'>" . htmlspecialchars($row['goal']) . "</td>
          </tr>";
}
echo "</table></center>";
?>

</body>
</html>