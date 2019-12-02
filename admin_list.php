<html>

<head>
<title>Admin</title>
</head>

<body>
<?php
	$table = $_GET["table"];
	echo "People list on table: ".$table."<br>";
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `Name`,`WWID` FROM `employee` WHERE `reserve_table` = $table";
	if ($result=mysqli_query($con,$sql))
	{
		while ($row=mysqli_fetch_array($result))
		{
			echo $row["WWID"]."-----------".$row["Name"]."<br>";
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>
</body>

</html>