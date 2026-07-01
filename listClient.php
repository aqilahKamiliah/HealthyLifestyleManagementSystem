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
    <h2>All Clients</h2>
</div>

<!-- Simple Search Bar -->
<div class="search-filter">
  <form method="GET" action="">
    <input type="text" name="search" placeholder="Search clients..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
    <button type="submit">Search</button>
  </form>
</div>

<?php
// Handle search input
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT u.user_id, u.name, u.email, c.goal, c.age, c.gender, c.height, c.weight 
            FROM users u 
            INNER JOIN client c ON u.user_id = c.user_id
            WHERE u.name LIKE '%$search%' 
               OR u.email LIKE '%$search%' 
               OR c.goal LIKE '%$search%'";
} else {
    $sql = "SELECT u.user_id, u.name, u.email, c.goal, c.age, c.gender, c.height, c.weight 
            FROM users u 
            INNER JOIN client c ON u.user_id = c.user_id";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Create table with expanded headings
echo "<center><table border='1' cellspacing='1' cellpadding='5' width='90%'>";
echo "<tr style='background: #f5f5f5'>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Height (cm)</th>
        <th>Weight (kg)</th>
        <th>Goal</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
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
} else {
    echo "<tr><td colspan='8' style='text-align:center;'>No clients found.</td></tr>";
}
echo "</table></center>";
?>

</body>
</html>