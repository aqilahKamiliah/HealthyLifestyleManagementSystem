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
    <h2>All Foods</h2>
    <button id="addButton" name="addButton" onclick="window.location.href='addFood.php'">+ Add Food</button>
</div>

<!-- Centered Search and Category Filter -->
<div class="search-filter">
    <form method="GET" action="">
        <div class="filter-container">
            <input type="text" name="search" placeholder="Search food..." 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            
            <select name="category" onchange="this.form.submit()">
                <option value="">-- Sort by Category --</option>
                <?php
                $catQuery = "SELECT DISTINCT category FROM food ORDER BY category ASC";
                $catResult = mysqli_query($conn, $catQuery);
                while ($catRow = mysqli_fetch_assoc($catResult)) {
                    $selected = (isset($_GET['category']) && $_GET['category'] == $catRow['category']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($catRow['category']) . "' $selected>" . htmlspecialchars($catRow['category']) . "</option>";
                }
                ?>
            </select>

            <button type="submit">Search</button>
        </div>
    </form>
</div>

<?php
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

$sql = "SELECT food_id, food_name, category, calorie FROM food WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (food_name LIKE '%$search%' OR category LIKE '%$search%')";
}
if (!empty($category)) {
    $sql .= " AND category='$category'";
}

$sql .= " ORDER BY category ASC, food_name ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

echo "<center><table border='1' cellspacing='1' cellpadding='2' width='80%'>";
echo "<tr style='background: #f5f5f5'>
        <th><center>Food Name</th>
        <th><center>Categories</th>
        <th><center>Calories (kcal)</th>
        <th><center>Actions</th>
      </tr>";

if (mysqli_num_rows($result) > 0) {
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
} else {
    echo "<tr><td colspan='4' align='center'>No foods found.</td></tr>";
}
echo "</table></center>";
?>

</body>
</html>
