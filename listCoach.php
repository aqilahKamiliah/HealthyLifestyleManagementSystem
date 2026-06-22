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
    <h3>All Coaches</h3>
    <button id="addButton" name="addButton" onclick="window.location.href='addCoach.php'">+ Add Coach</button>
</div>

<?php
// SQL Query joining users and coach tables
$sql = "SELECT u.user_id, u.name, u.email, c.specialization, c.experience_years 
        FROM users u 
        JOIN coach c ON u.user_id = c.user_id";
$result = mysqli_query($conn, $sql);

#Create table and six headings
echo "<center><table border='1' cellspacing='1' cellpadding='2' width='80%'>";
echo "<tr style='background: #f5f5f5'>
        <th><center>Name</th>
        <th><center>Email</th>
        <th><center>Specialization</th>
        <th><center>Experience (Years)</th>
        <th><center>Actions</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td>" . htmlspecialchars($row['specialization']) . "</td>
            <td align='center'>" . htmlspecialchars($row['experience_years']) . "</td>
            <td align='center'>
                <a href='editCoach.php?id=" . $row['user_id'] . "'>Edit</a> | 
                <a href='deleteCoach.php?id=" . $row['user_id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
          </tr>";
}
echo "</table></center>";
?>
</body>
</html>