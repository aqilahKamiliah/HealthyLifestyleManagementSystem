<?php include 'headerClient.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .dashboard-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-spacing: 20px 0;
            margin-top: 20px;
        }
        .dashboard-col {
            display: table-cell;
            vertical-align: top;
            background-color: #e8f5e9; 
            border-radius: 12px;
            padding: 25px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #1b5e20; 
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .progress-box {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 25px auto;
            background: radial-gradient(circle, #e8f5e9 60%, transparent 61%), 
                        conic-gradient(#4caf50 0% 65%, #c8e6c9 65% 100%); 
            border-radius: 50%;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
        }

        .progress-text .percentage {
            font-size: 32px;
            font-weight: bold;
            color: #111;
            display: block;
        }

        .progress-text .stats {
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        .stat-badges {
            text-align: center;
        }

        .badge {
            display: inline-block;
            width: 28%;
            margin: 0 2px;
            padding: 8px 4px;
            border-radius: 6px;
            color: white;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
        }

        .badge-current { background-color: #4caf50; } 
        .badge-goal { background-color: #2e7d32; }   
        .badge-remaining { background-color: #81c784; } 

        .badge span {
            display: block;
            font-size: 10px;
            font-weight: normal;
            margin-bottom: 4px;
            opacity: 0.9;
        }

        .log-item {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 10px 15px;
            margin-bottom: 12px;
            border: 1px solid #c8e6c9;
        }

        .log-icon {
            display: inline-block;
            width: 30px;
            font-size: 20px;
            vertical-align: middle;
        }

        .log-details {
            display: inline-block;
            width: calc(100% - 40px);
            vertical-align: middle;
            font-size: 13px;
        }

        .log-details b { color: #222; }
        .log-details span { color: #666; float: right; font-size: 12px; margin-top: 2px; }

        .btn-log-meal {
            display: block;
            width: 80%;
            margin: 20px auto;
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            font-size: 13px;
        }

        .btn-log-meal:hover {
            background-color: #388e3c;
        }

        .todo-section {
            border-top: 1px solid #c8e6c9;
            padding-top: 15px;
            margin-top: 15px;
        }

        .todo-section h4 { margin: 0 0 10px 0; font-size: 15px; color: #2e7d32; }

        .todo-item {
            margin-bottom: 8px;
            font-size: 13px;
            color: #333;
        }

        .todo-item input { margin-right: 8px; vertical-align: middle; }

        .section-sub-title {
            font-size: 14px;
            font-weight: bold;
            color: #2e7d32;
            margin: 15px 0 8px 0;
        }

        .exercise-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #c8e6c9;
        }

        .exercise-card .ex-title {
            font-size: 13px;
            font-weight: bold;
            color: #111;
            margin-bottom: 2px;
        }

        .exercise-card .ex-desc {
            font-size: 11px;
            color: #666;
        }

        .coach-message {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #c8e6c9;
        }

        .coach-text {
            display: inline-block;
            width: calc(100% - 35px);
            vertical-align: middle;
            font-size: 12px;
        }
        
        .coach-text i { color: #555; }
    </style>
</head>
<body>

<div class="dashboard-container">
    
    <div class="dashboard-grid">
        
        <div class="dashboard-col">
            <h3 class="card-title">Daily Calories Consumed</h3>
            
            <div class="progress-box">
                <div class="progress-text">
                    <span class="percentage">65%</span>
                    <span class="stats">1,365 / 2,100<br>kcal</span>
                </div>
            </div>

            <div class="stat-badges">
                <div class="badge badge-current">
                    <span>Current Intake:</span>1,365 kcal
                </div>
                <div class="badge badge-goal">
                    <span>Goal:</span>2,100 kcal
                </div>
                <div class="badge badge-remaining">
                    <span>Remaining:</span>735 kcal
                </div>
            </div>
        </div>

        <div class="dashboard-col">
            <h3 class="card-title" style="text-align: left;">Today's Activity & Log</h3>
            <span style="font-size: 13px; font-weight: bold; color: #555; display:block; margin-bottom: 10px;">Today</span>
            
            <div class="log-item">
                <div class="log-icon">🍳</div>
                <div class="log-details">
                    <b>Breakfast: Scrambled Eggs</b>
                    <span>(350 kcal)</span>
                </div>
            </div>

            <div class="log-item">
                <div class="log-icon">🍎</div>
                <div class="log-details">
                    <b>Snack: Apple</b>
                    <span>(95 kcal)</span>
                </div>
            </div>

            <button class="btn-log-meal">+ LOG A NEW MEAL</button>

            <div class="todo-section">
                <h4>To-Do List</h4>
                <div class="todo-item"><input type="checkbox"> Log Lunch</div>
                <div class="todo-item"><input type="checkbox"> 30min Walk</div>
                <div class="todo-item"><input type="checkbox"> Log Dinner</div>
            </div>
        </div>
        <div class="dashboard-col">
            <h3 class="card-title" style="text-align: left; font-size: 18px;">Fitness & Exercise Recommender</h3>
            
            <div class="exercise-card">
                <div class="ex-title">🏃‍♂️ Today's Workout</div>
                <div class="ex-desc">Full Body Blast (Est. Burn: 180 kcal, 30 min)</div>
            </div>

            <div class="exercise-card">
                <div class="ex-title">🚶‍♂️ Suggested Activity</div>
                <div class="ex-desc">Daily Brisk Walk (Est. Burn: 110 kcal, 20 min)</div>
            </div>

            <div class="section-sub-title">My Recent Logged Exercises</div>
            <div class="exercise-card">
                <div class="ex-title">🧘‍♂️ Yesterday</div>
                <div class="ex-desc">Yoga (40 min, 200 kcal)</div>
            </div>

            <div class="section-sub-title">Daily Guidance</div>
            <div class="coach-message">
                <div class="log-icon">📋</div>
                <div class="coach-text">
                    <b>Message from Coach Sarah</b><br>
                    <i>"Log your breakfast before 9 AM!"</i>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>