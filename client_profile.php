<?php include 'headerClient.php'; ?>

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