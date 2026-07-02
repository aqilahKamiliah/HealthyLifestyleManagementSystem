<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM client WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: client_bio.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $activity_level = $_POST['activity_level'];
    $goal = $_POST['goal'];

    $update = "UPDATE client SET
               age = '$age',
               gender = '$gender',
               weight = '$weight',
               height = '$height',
               activity_level_id = '$activity_level',
               goal = '$goal'
               WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>
            alert('Profile updated successfully!');
            window.location='client_profile.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<?php include 'headerClient.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="style1.css">

    <style>
        .edit-container {
            max-width: 800px;
            margin: 40px auto;
            background: #e8f5e9;
            padding: 35px;
            border-radius: 15px;
        }

        .edit-container h2 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .form-group label {
            display: block;
            color: #2e7d32;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            box-sizing: border-box;
        }

        .btn-area {
            text-align: right;
            margin-top: 30px;
        }

        .btn-area button {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
</head>

<body>

<div class="edit-container">
    <h2>Edit Profile</h2>

    <form method="POST">

        <div class="form-grid">

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo $data['age']; ?>" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" required>
                    <option value="Male" <?php if($data['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($data['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Weight (kg)</label>
                <input type="number" step="0.1" name="weight" value="<?php echo $data['weight']; ?>" required>
            </div>

            <div class="form-group">
                <label>Height (cm)</label>
                <input type="number" step="0.1" name="height" value="<?php echo $data['height']; ?>" required>
            </div>

            <div class="form-group">
                <label>Activity Level</label>
                <select name="activity_level" required>
                    <option value="1" <?php if($data['activity_level_id'] == 1) echo 'selected'; ?>>Low</option>
                    <option value="2" <?php if($data['activity_level_id'] == 2) echo 'selected'; ?>>Moderate</option>
                    <option value="3" <?php if($data['activity_level_id'] == 3) echo 'selected'; ?>>High</option>
                    
                </select>
            </div>

            <div class="form-group">
                <label>Goal</label>
                <select name="goal" required>
                    <option value="Lose Weight" <?php if($data['goal'] == 'Lose Weight') echo 'selected'; ?>>Lose Weight</option>
                    <option value="Maintain Weight" <?php if($data['goal'] == 'Maintain Weight') echo 'selected'; ?>>Maintain Weight</option>
                    <option value="Gain Weight" <?php if($data['goal'] == 'Gain Weight') echo 'selected'; ?>>Gain Weight</option>
                </select>
            </div>

        </div>

        <div class="btn-area">
            <button type="submit">Save Changes</button>
        </div>

    </form>
</div>

</body>
</html>