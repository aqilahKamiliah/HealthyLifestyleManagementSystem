<?php include 'headerClient.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .suggestion-page-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .suggestion-grid {
            display: flex;
            gap: 25px;
        }

        .suggestion-col-card {
            flex: 1;
            background-color: #e8f5e9; 
            border-radius: 4px;
            padding: 30px 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            min-height: 450px;
        }


        .suggestion-col-card h2 {
            font-size: 28px;
            font-weight: bold;
            color: #1b5e20; 
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .sub-title {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }


        .suggestion-item-box {
            background-color: #f1f8e9; 
            border: 2px solid #111111; 
            border-radius: 20px; 
            padding: 15px 20px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            color: #111111;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }


        .item-icon-box {
            width: 18px;
            height: 18px;
            border: 2px solid #111111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            background-color: #ffffff;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<div class="suggestion-page-container">
    <div class="suggestion-grid">

        <div class="suggestion-col-card">
            <h2>Meal Suggestions</h2>
            <div class="sub-title">Today's Lunch</div>
            
            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>Grilled Chicken Salad</span>
            </div>

            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>Tuna Stuffed Avocado</span>
            </div>

            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>Berry Smoothie</span>
            </div>
        </div>

        <div class="suggestion-col-card">
            <h2>Workout Suggestions</h2>
            <div style="height: 45px;"></div> 
            
            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>Cardio Steady Paced<br><span style="font-size: 16px; font-weight: normal; color: #444;">30 Minutes</span></span>
            </div>

            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>50 Jumping Jacks</span>
            </div>

            <div class="suggestion-item-box">
                <div class="item-icon-box">─</div>
                <span>25 Walking Lunges</span>
            </div>
        </div>

    </div>
</div>

</body>
</html>