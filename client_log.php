<!DOCTYPE html>
<html>
<head>
    <title>Client Weight Log</title>
</head>
<body>

<h1>Client Weight Log</h1>

<nav>
    <a href="client_home.php">Home</a> |
    <a href="client_profile.php">Profile</a> |
    <a href="client_log.php">Weight Log</a> |
    <a href="client_suggestions.php">Suggestions</a> |
</nav>

<hr>

<h2>Log Your Weight</h2>

<form action="save_weight.php" method="POST">

    Food Name:
    <input type="text" name="foodnames" placeholder="e.g. Nasi Lemak" required>

    <br><br>

    Calorie (kcal):
    <input type="number" name="calorie" placeholder="e.g. 400" required>

    <br><br>

    Meal Type:
    <select name="mealtype" required>
        <option value="">-- Select Meal Type --</option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
        <option value="Snack">Snack</option>
    </select>

    <br><br>

    Log Date:
    <input type="date" name="date" required>

    <br><br>

    <button type="submit">
        Save Food Log
    </button>

</form>

</body>
</html>