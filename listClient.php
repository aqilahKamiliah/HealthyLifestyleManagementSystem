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
    <h3>All Clients</h3>
</div>

<?php
$fp = fopen("clientList.txt", "r") or die("Couldn't open the file");

#Create table and six headings
echo "<center><table border ='1' cellspacing ='1' cellpadding='2' valign 'center' width=50% >";
echo "<tr style ='background: #f5f5f5'>"
."<th>User ID</th>"
."<th>Name</th>"
."<th>Email</th>"
."<th>Goal</th>"
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
		echo "</tr>";
	}
	echo "</table></center>";

fclose($fp);
?> 

</body>
</html>