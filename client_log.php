<?php include 'headerClient.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Log</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .log-page-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-title-box {
            background-color: #e8f5e9; 
            border-radius: 8px 8px 0 0;
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid #c8e6c9;
        }

        .page-title-box h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            color: #1b5e20; /* Hijau pekat */
        }

        .log-section-card {
            background-color: #e8f5e9; 
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .food-section {
            border-bottom: 2px solid #ffffff; 
        }

        .exercise-section {
            border-radius: 0 0 8px 8px;
        }

        .log-section-card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: bold;
            color: #111;
        }

        .log-grid {
            display: flex;
            gap: 20px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .log-group {
            flex: 1;
            min-width: 180px;
            display: flex;
            flex-direction: column;
        }

        .log-group label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #111;
        }

        .log-group input[type="text"],
        .log-group input[type="number"],
        .log-group select {
            background-color: #ffffff;
            border: 1px solid #c8e6c9;
            border-radius: 20px;
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-submit-container {
            flex: 1;
            min-width: 180px;
            text-align: right;
        }

        .btn-log-submit {
            background-color: #ffffff;
            color: #2e7d32;
            border: 2px solid #4caf50;
            border-radius: 20px;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn-log-submit:hover {
            background-color: #4caf50;
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="log-page-container">

    <div class="page-title-box">
        <h2>My Daily Log</h2>
    </div>

    <div class="log-section-card food-section">
        <h3>Food Log</h3>
        
        <form action="process_food_log.php" method="POST">
            <div class="log-grid">
                
                <div class="log-group">
                    <label>Meal</label>
                    <select name="meal" required>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Snack">Snack</option>
                    </select>
                </div>

                <div class="log-group">
                    <label>Food Item</label>
                    <input type="text" name="food_item" placeholder="e.g. Nasi Lemak" required>
                </div>

            

                <div class="log-group">
                    <label>Calories (kcal)</label>
                    <input type="number" name="calorie" placeholder="e.g. 250" min="0" required>
                </div>

                <div class="btn-submit-container">
                    <button type="submit" class="btn-log-submit">
                        + LOG FOOD<br><span style="font-size: 11px; font-weight: normal;">(Submit)</span>
                    </button>
                </div>

            </div>
        </form>
    </div>

    <div class="log-section-card exercise-section">
        <h3>Exercise Log</h3>
        
        <form action="process_exercise_log.php" method="POST">
            <div class="log-grid">
                
                <div class="log-group">
                    <label>Activity</label>
                    <select name="activity" required>
                        <option value="Walking">Walking</option>
                        <option value="Running">Running</option>
                        <option value="Cardio">Cardio</option>
                        <option value="Strength">Strength</option>
                    </select>
                </div>

                <div class="log-group">
                    <label>Duration (min)</label>
                    <input type="number" name="duration" placeholder="e.g. 30" required>
                </div>

                <div class="log-group">
                    <label>Intensity</label>
                    <select name="intensity" required>
                        <option value="" disabled selected>&lt;select&gt;</option>
                        <option value="Low">Low</option>
                        <option value="Moderate">Moderate</option>
                        <option value="High">High</option>
                    </select>
                </div>

                <div class="btn-submit-container">
                    <button type="submit" class="btn-log-submit">
                        + LOG EXERCISE<br><span style="font-size: 11px; font-weight: normal;">(Submit)</span>
                    </button>
                </div>

            </div>
        </form>
    </div>

</div>

</body>
</html>