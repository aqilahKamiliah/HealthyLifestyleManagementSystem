<!DOCTYPE html>
<html>
<head>
    <title>Client - Enter Bio Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<h1>Welcome to Healthy Lifestyle Management System</h1>

<hr>

<h2>Please Enter Your Biodata</h2>
<p>Before entering the dashboard, please fill in your details below:</p>

<form action="client_home.php" method="POST">

    Name:
    <input type="text" name="name" required>

    <br><br>

    Age:
    <input type="number" name="age" required>

    <br><br>

    Gender:
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <br><br>

    Height (cm):
    <input type="number" step="0.1" name="height" placeholder="e.g. 165.5" required>

    <br><br>

    Weight (kg):
    <input type="number" step="0.1" name="weight" placeholder="e.g. 60.2" required>

    <br><br>

    <button type="submit">
        Submit & Enter Dashboard
    </button>

</form>

</body>
</html>