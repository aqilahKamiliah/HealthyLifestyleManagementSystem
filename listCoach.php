<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy LifeStyle Management System</title>
    <link rel="stylesheet" type="text/css" href="styleAdmin.css">
</head>
<body>
<?php 
include("headerAdmin.php");
?>

<div class="page-header">
    <h3>All Coaches</h3>
    <button id="addButton" name="addButton" onclick="window.location.href='addCoach.php'">+ Add Coach</button>
</div>

<?php
$fp = fopen("coachList.txt", "r") or die("Couldn't open the file");

#Create table and six headings
echo "<center><table border ='1' cellspacing ='1' cellpadding='2' valign 'center' width=50% >";
echo "<tr style ='background: #f5f5f5'>"
."<th>Name</th>"
."<th>Email</th>"
."<th>Phone Number</th>"
."<th>Specialization</th>"
."<th>Password</th>"
."</tr>";

while(!feof($fp))
	{
		$data = fgets($fp,1024);
		$values = chop ($data);
		$val = explode("\t", $values);
		echo "<tr><td> " . $val[0] . " </td>";
		echo "<td align = 'center'>". $val[1] . "</td>";
		echo "<td align = 'center'>". $val[2] . "</td>";
		echo "<td align = 'center'>". $val[3] . "</td>";
		echo "<td align = 'center'>". $val[4] . "</td>";
		echo "</tr>";
	}
	echo "</table></center>";

fclose($fp);
?> 

</body>
</html>