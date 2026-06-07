<?php include 'headerClient.php'; ?>

<?php

$coach = $_GET["coach"] ?? "No Coach Selected";
$coach = htmlspecialchars($coach);

$descriptions = [
    "Sarah" => "Weight Management, Meal Planning, Calorie Tracking",
    "Maria" => "Stress Management, Flexibility & Mobility, Mindfulness & Meditation",
    "Aaron" => "Muscle Building & Toning, Resistance Training, Athletic Performance",
    "Faeeq" => "Running & Cycling Prep, Cardiovascular Health, Stamina Building",
    "Jack" => "Rapid Fat Loss, Lean Muscle Gain, Metabolic Optimization",
    "Sofee" => "Healthy Weight Loss, Hormonal Friendly Dieting, Body Recomposition"
];

$description = $descriptions[$coach] ?? "Coach information unavailable";
?>

<div class="container">

    <div class="left-panel">
    <h2>My Coach</h2>
    <div class="coach-profile">
        <div class="avatar"></div>
        <h3><?php echo $coach; ?></h3>
        <p><?php echo $description; ?></p>
    </div>

    <div class="reminder-box">
    <h2>Reminder Messages</h2>
    <p>
        Remember to track your meals daily and
        stay hydrated throughout the day.
    </p>
    </div>
</div>
    
<div class="right-panel">
    <h2>Evaluation Progress</h2>

    <div class="stars">
    <span>★</span>
    <span>★</span>
    <span>★</span>
    <span>★</span>
    <span>★</span>
    </div>

    <h3>Goal Completion</h3>
    <input type="range" value="70">

    <h3>Rate Your Coach</h3>
    <div class="stars">
    <span>★</span>
    <span>★</span>
    <span>★</span>
    <span>★</span>
    <span>★</span>
    </div>

    <h3>Challenges Faced</h3>
    <textarea rows="5"></textarea>
    <br><br>
    <button>Submit</button>
    
    </div>
</div>

</body>
</html>