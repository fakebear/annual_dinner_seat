<html>

<head>
<title>Intel Annual Dinner 2019 Table Reservation</title>
</head>

<body>
<table cellspacing="10" align="center">
<?php
	$total_table = 35;
	
	
	for($i=1; $i<=$total_table; $i++) {
		$tables[$i] = 0;
	}
	
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `reserve_table`, COUNT(WWID) FROM `employee` GROUP BY `reserve_table`";
	
	if ($result=mysqli_query($con,$sql))
	{
		// 一条条获取
		while ($row=mysqli_fetch_row($result))
		{
			$tables[$row[0]] = $row[1];
		}
		//$tables = mysqli_fetch_all($result,MYSQLI_ASSOC);
		// 释放结果集合
		mysqli_free_result($result);
	}

	mysqli_close($con);

	
	$table=1;
	for($i=1; $i<=7; $i++) {
		echo "<tr>";
		for($j=1; $j<=5; $j++){
			//SQL
			if($tables[$table]<10) {
				printf ("<td><a href=\"table_detail.php?table=%d\"> <img src=\"./img/green.png\" width=100 height=100/><br>$table </td>", $table);
			}else {
				printf ("<td><a href=\"table_detail.php?table=%d\"> <img src=\"./img/red.png\" width=100 height=100/><br>$table </td>", $table);
			}
			$table++;
		}
		echo "<tr>";
	}
?>
</table>
</body>

</html>