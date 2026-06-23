<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<?php
include("headerAdmin.php");
include("connection.php");

// Fetch existing data
$id = (int)$_GET['id']; // Safety: cast to integer
$query = mysqli_query($conn, "SELECT * FROM food WHERE food_id = $id");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['foodName']);
    $cat = mysqli_real_escape_string($conn, $_POST['categories']);
    $cal = (int)$_POST['calories'];

    mysqli_query($conn, "UPDATE food SET food_name='$name', category='$cat', calorie='$cal' WHERE food_id=$id");
    header("Location: listFood.php");
    exit();
}
?>

<section>
    <div class="container">
        <div class="coachContainer">
            <h3 class="center">Edit Food Information</h3>
            <form method="POST">
                <table>
                    <tr>
                        <td>Food Name</td>
                        <td><input type="text" name="foodName" value="<?php echo htmlspecialchars($data['food_name']); ?>" required /></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="categories">
                                <option value="Protein" <?php if($data['category'] == 'Protein') echo 'selected'; ?>>Protein</option>
                                <option value="Carbohydrate" <?php if($data['category'] == 'Carbohydrate') echo 'selected'; ?>>Carbohydrate</option>
                                <option value="Fruits/Vegetable" <?php if($data['category'] == 'Fruits/Vegetable') echo 'selected'; ?>>Fruits/Vegetable</option>
                                <option value="Beverages" <?php if($data['category'] == 'Beverages') echo 'selected'; ?>>Beverages</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Calories (kcal)</td>
                        <td><input type="number" name="calories" value="<?php echo htmlspecialchars($data['calorie']); ?>" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input name="update" type="submit" value="Update Food"/>
                            <input type="button" value="Cancel" onclick="window.location.href='listFood.php'"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
</body>
</html>