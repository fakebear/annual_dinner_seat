<html>

<head>
<title>Intel Annual Dinner 2019 Table Reservation</title>
</head>

<body>
<table border="0" cellpadding="1" cellspacing="1" style="width:100%;" height="108" background="./img/intel_banner.jpg">
 <tbody>
 <tr>
 <td>
 <span style="color:#FFFF00;">
 <span style="font-size:28px;">2019 Intel Annual Dinner</span></span></td>
 <td>
 <form align="right" action="check_wwid.php" method="post">
 <span style="color:#FFFF00;">
 <span style="font-size:28px;">Check my Reservation<br></span></span>
<input type="text" maxlength="8" onkeyup="this.value=this.value.replace(/\D/g,'')" name="wwid" required="required">
<input type="submit">
</form>
</td>
 </tr>
 </tbody>
</table>


<table cellspacing="20" align="center">
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