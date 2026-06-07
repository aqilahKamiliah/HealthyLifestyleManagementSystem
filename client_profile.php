<?php include 'headerClient.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css"> 
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .profile-page-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* --- STYLING KAD UTAMA (HIJAU LEMBUT) --- */
        .green-card {
            background-color: #e8f5e9; /* Hijau lembut matching sistem */
            border-radius: 8px;
            padding: 20px 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* --- KAD ATAS: USER INFO --- */
        .user-header-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-meta {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .avatar-circle {
            width: 60px;
            height: 60px;
            background-color: #c8e6c9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #2e7d32;
        }

        .user-name-title h2 {
            margin: 0;
            font-size: 28px;
            color: #111;
        }

        .user-name-title span {
            font-size: 13px;
            color: #666;
        }

        .bmi-score-box {
            text-align: right;
        }

        .bmi-score-box h3 {
            margin: 0;
            font-size: 24px;
            color: #1b5e20;
        }

        .bmi-score-box span {
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        /* --- SUSUNAN GRID TENGAH (2 KOLUM) --- */
        .profile-middle-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .middle-col {
            flex: 1;
            padding: 25px;
        }

        .middle-col h3 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 24px;
            color: #1b5e20;
        }

        /* Snapshot Table/List Styling */
        .snapshot-table {
            width: 100%;
            border-collapse: collapse;
        }

        .snapshot-table td {
            padding: 12px 0;
            font-size: 18px;
            color: #333;
        }

        .snapshot-table td:last-child {
            text-align: right;
            font-weight: 500;
            color: #111;
        }

        /* Tracking Goal Internal Layout */
        .goal-flex-container {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 15px;
        }

        /* Mini Progress Circle */
        .mini-progress-box {
            position: relative;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, #e8f5e9 60%, transparent 61%), 
                        conic-gradient(#4caf50 0% 65%, #c8e6c9 65% 100%); 
            border-radius: 50%;
        }

        .mini-progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
        }

        .mini-progress-text .pct {
            font-size: 22px;
            font-weight: bold;
            color: #111;
            display: block;
        }

        .mini-progress-text .sub-pct {
            font-size: 10px;
            color: #555;
        }

        .goal-details-text {
            font-size: 16px;
            color: #333;
        }

        .goal-details-text h4 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: #555;
            font-weight: normal;
        }

        .goal-details-text p {
            margin: 0 0 15px 0;
            font-size: 22px;
            font-weight: bold;
            color: #111;
        }

        .goal-details-text p span {
            font-size: 12px;
            font-weight: normal;
            color: #666;
            display: block;
        }

        /* --- KAD BAWAH: COACH INFO --- */
        .coach-footer-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .coach-meta-text {
            width: 100%;
            font-size: 16px;
        }

        .coach-meta-text b {
            font-size: 20px;
            color: #111;
        }

        .coach-meta-text .cert-tag {
            float: right;
            font-size: 16px;
            color: #444;
        }
    </style>
</head>
<body>

<div class="profile-page-container">

    <!-- 1. KAD UTASA ATAS (User Info & BMI) -->
    <div class="green-card user-header-card">
        <div class="user-meta">
            <div class="avatar-circle">👤</div>
            <div class="user-name-title">
                <h2>Ali</h2>
                <span>Standard User</span>
            </div>
        </div>
        <div class="bmi-score-box">
            <h3>BMI : 29.4</h3>
            <span>Overweight</span>
        </div>
    </div>

    <!-- 2. GRID TENGAH (Biometric & Daily Goal) -->
    <div class="profile-middle-grid">
        
        <!-- Kolum Kiri: Biometric Snapshot -->
        <div class="green-card middle-col">
            <h3>Biometric Snapshot</h3>
            <table class="snapshot-table">
                <tr>
                    <td>Age :</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>Gender :</td>
                    <td>Male</td>
                </tr>
                <tr>
                    <td>Current Weight :</td>
                    <td>85 kg</td>
                </tr>
                <tr>
                    <td>Height :</td>
                    <td>170 cm</td>
                </tr>
            </table>
        </div>

        <!-- Kolum Kanan: Daily Tracking Goal -->
        <div class="green-card middle-col">
            <h3>Daily Tracking Goal</h3>
            <div class="goal-flex-container">
                
                <!-- Bulatan Progres -->
                <div class="mini-progress-box">
                    <div class="mini-progress-text">
                        <span class="pct">65%</span>
                        <span class="sub-pct">1,365 / 2,100 kcal</span>
                    </div>
                </div>

                <!-- Maklumat Teks Kalori -->
                <div class="goal-details-text">
                    <h4>Target Intake :</h4>
                    <p>2100 kcal <span>( For Weight Loss )</span></p>
                    
                    <h4>Avg. Intake :</h4>
                    <p style="margin-bottom: 0;">2000 kcal</p>
                </div>

            </div>
        </div>

    </div>

    <!-- 3. KAD BAWAH (Coach Info) -->
    <div class="green-card coach-footer-card">
        <div class="avatar-circle" style="width: 45px; height: 45px; font-size: 22px;">👤</div>
        <div class="coach-meta-text">
            <span>Your Coach :</span><br>
            <b>Sarah</b>
            <span class="cert-tag">( Certified Nutritionist )</span>
        </div>
    </div>

</div>

</body>
</html>