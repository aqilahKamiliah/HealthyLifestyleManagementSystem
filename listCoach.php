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
    <h2>All Coaches</h2>
    <button id="addButton" name="addButton" onclick="window.location.href='addCoach.php'">+ Add Coach</button>
</div>

<!-- Search Bar -->
<div class="search-filter">
  <form method="GET" action="">
    <input type="text" name="search" placeholder="Search by name, email, or specialization..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
    <button type="submit">Search</button>
  </form>
</div>

<?php
// Handle search input
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT u.user_id, u.name, u.email, c.specialization, c.experience_years 
            FROM users u 
            JOIN coach c ON u.user_id = c.user_id
            WHERE u.name LIKE '%$search%' 
               OR u.email LIKE '%$search%' 
               OR c.specialization LIKE '%$search%'";
} else {
    $sql = "SELECT u.user_id, u.name, u.email, c.specialization, c.experience_years 
            FROM users u 
            JOIN coach c ON u.user_id = c.user_id";
}

$result = mysqli_query($conn, $sql);

# Create table and headings
echo "<center><table border='1' cellspacing='1' cellpadding='5' width='90%'>";
echo "<tr>
        <th>Name</th>
        <th>Email</th>
        <th>Specialization</th>
        <th>Experience (Years)</th>
        <th>Actions</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
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
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>No coaches found.</td></tr>";
}
echo "</table></center>";
?>

</body>
</html>