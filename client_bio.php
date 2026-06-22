<?php include 'headerClient.php'; 
include 'connection.php';?>
<?php
include 'connection.php';
if (isset($_POST['save_bio'])) {
    
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity_level = $_POST['activity_level_id'];
    
    $user_id = 2; 
    $coach_id = 1;

    $query = "INSERT INTO Client (age, gender, height, weight, activity_level_id, user_id, coach_id) 
              VALUES ('$age', '$gender', '$height', '$weight', '$activity_level', '$user_id', '$coach_id')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Maklumat kesihatan berjaya disimpan!'); window.location='client_home.php';</script>";
        exit();
    } else {
        echo "Ralat menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Your Needs</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fcfcfc;
            color: #333;
        }

        .main-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }

        .main-container h1 {
            font-size: 28px;
            font-weight: normal;
            margin-bottom: 5px;
            color: #111;
        }

        .main-container .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 40px;
            line-height: 1.4;
        }

        .form-card {
            background-color: #e8f5e9;
            border-radius: 16px;
            padding: 40px;
            text-align: left;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 12px;
            color: #2e7d32;
        }

        .form-group input[type="number"],
        .form-group input[type="text"],
        .form-group select {
            background-color: #ffffff;
            border: none;
            border-radius: 20px; 
            padding: 10px 15px;
            font-size: 14px;
            color: #666;
            outline: none;
            width: 100%;
            box-sizing: border-box;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }

        .gender-options {
            display: flex;
            gap: 15px;
            align-items: center;
            height: 40px; 
        }

        .gender-options label {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .btn-container {
            margin-top: 30px;
            text-align: right;
        }

        .btn-container button {
            background-color: #6c5ce7;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-container button:hover {
            background-color: #5b4cc4;
        }
    </style>
</head>
<body>

<div class="main-container">
    
    <h1>Calculate Your Needs</h1>
    <div class="subtitle">
        Complete the form below to determine your current health metrics and daily calorie requirement.
    </div>

    <div class="form-card">
        <form action="client_profile.php" method="POST">
               
            <div class="form-grid">
                
                <div class="form-group" style="grid-column: span 3;">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="gender-options">
                        <label><input type="radio" name="gender" value="Male" checked> Male</label>
                        <label><input type="radio" name="gender" value="Female"> Female</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" placeholder="Number" required>
                </div>

                <div></div>

                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="Number" required>
                </div>

                <div class="form-group">
                    <label>Height (cm)</label>
                    <input type="number" name="height" placeholder="Number" required>
                </div>

                <div class="form-group">
                    <label>Activity Level</label>
                    <select name="activity_level" required>
                        <option value="" disabled selected>Select level</option>
                        <option value="Not Very Active">Not Very Active</option>
                        <option value="Lightly Active">Lightly Active</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Active">Active</option>
                        <option value="Very Active">Very Active</option>
                    </select>
                </div>

            </div>

            <div class="btn-container">
                <button type="submit">Continue</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>