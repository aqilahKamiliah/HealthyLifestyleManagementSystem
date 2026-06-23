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
include("connection.php"); // Ensure this file defines your $conn variable
?>

<div class="page-header">
    <h3>All Foods</h3>
    <button id="addButton" name="addButton" onclick="window.location.href='addFood.php'">+ Add Food</button>
</div>

<?php
// SQL Query to fetch all rows from the 'food' table
$sql = "SELECT food_id, food_name, category, calorie FROM food";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

echo "<center><table border='1' cellspacing='1' cellpadding='2' width='80%'>";
echo "<tr style='background: #f5f5f5'>
        <th><center>Food Name</th>
        <th><center>Categories</th>
        <th><center>Calories(kcal)</th>
		<th><center>Actions</th>
      </tr>";

// Fetch each row from the database and display it in the table
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td align='center'>" . htmlspecialchars($row['food_name']) . "</td>
            <td align='center'>" . htmlspecialchars($row['category']) . "</td>
            <td align='center'>" . htmlspecialchars($row['calorie']) . "</td>
			<td align='center'>
                <a href='editFood.php?id=" . $row['food_id'] . "'>Edit</a> | 
                <a href='deleteFood.php?id=" . $row['food_id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
          </tr>";
	}
echo "</table></center>";
?>

</body>
</html>