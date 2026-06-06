<!DOCTYPE html>
<html>
<head>
    <title>Recommendation</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
<style>
     .meal-box{
    display:block;
    text-decoration:none;
    color:black;
    border:1px solid #ccc;
    padding:10px;
    margin-top:10px;
    border-radius:8px;
    text-align:center;
    background-color:#f8f8f8;
    transition:0.3s;
}

.meal-box:hover{
    background-color:#e6e6ff;
    border-color:#6a5acd;
    color:#6a5acd;
    cursor:pointer;
}

.meal-box:active{
    background-color:#d6d6ff;
    transform:scale(0.98);
}
</style>
</head>
<body>

<?php include 'headerCoach.php'; ?>

<div style="width:80%; margin:30px auto;">

<h2>Make Recommendation</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">


   


    <!-- CLIENT CARD -->
    <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:220px;">
        <h3>Ali</h3>
        <p>Goal: Lose Weight</p>
        <p>2185 kcal/day</p>

        <a class="meal-box" href="recommend_food.php?client=Ali&meal=Breakfast">
            Breakfast
        </a>
        <a class="meal-box" href="recommend_food.php?client=Ali&meal=Lunch">
            Lunch
        </a>
        <a class="meal-box" href="recommend_food.php?client=Ali&meal=Dinner">
            Dinner
        </a>
    </div>

    <div style="border:1px solid #ccc; padding:20px; border-radius:10px; width:220px;">
        <h3>Maya</h3>
        <p>Goal: Maintain Weight</p>
        <p>1650 kcal/day</p>

        <a class="meal-box" href="recommend_food.php?client=Maya&meal=Breakfast">
            Breakfast
        </a>
        <a class="meal-box" href="recommend_food.php?client=Maya&meal=Lunch">
            Lunch
        </a>
        <a class="meal-box" href="recommend_food.php?client=Maya&meal=Dinner">
            Dinner
        </a>
    </div>

</div>

</div>

</body>
</html>