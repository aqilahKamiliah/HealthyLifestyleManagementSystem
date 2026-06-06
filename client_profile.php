<!DOCTYPE html>
<html>
<head>
    <title>Client Profile</title>
</head>
<body>

<h1>Client Profile</h1>

<nav>
    <a href="client_home.php">Home</a> |
    <a href="client_profile.php">Profile</a> |
    <a href="client_log.php">Weight Log</a> |
    <a href="client_suggestions.php">Suggestions</a> |
    
</nav>

<hr>

<h2>Profile Info</h2>

<form action="bio.php" method="POST">

    Name:
    <input type="text" name="name" required>

    <br><br>

    Age:
    <input type="number" name="age" required>

    <br><br>

    Gender:
    <select name="gender">
        <option>Male</option>
        <option>Female</option>
    </select>

    <br><br>

    <button type="submit">
        Continue
    </button>

</form>

</body>
</html>