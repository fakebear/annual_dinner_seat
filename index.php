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
<input type="text" placeholder="WWID..." maxlength="8" onkeyup="this.value=this.value.replace(/\D/g,'')" name="wwid" required="required">
<input type="submit">
</form>
</td>
 </tr>
 </tbody>
</table>

<div align="right">
<a href="mailto:mia.zhang@intel.com">Issue Report</a>
</div>

<img src="./img/stage.png" style='display: block;margin-left: auto;margin-right: auto;width:30%'/>
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
			if($i==1 && $j==1) {
				echo "<td width=100 height=100></td>";
			}else if($i==1 && $j==5) {
				echo "<td width=100 height=100></td>";
			//}else if($i==7 && $j==5) {
			//	echo "<td width=100 height=100></td>";
			//}else if($i==7 && $j==3) {
			//	echo "<td width=100 height=100></td>";
			//}else if($i==7 && $j==1) {
			//	echo "<td width=100 height=100></td>";
			}else {
				echo "<td>";
				printf("<a href=\"table_detail.php?table=%d\">", $table);
				if($tables[$table]==0) {
					//printf ("<td><a href=\"table_detail.php?table=%d\"> <img src=\"./img/green.png\" width=100 height=100/><br>$table </td>", $table);
					echo "<div style='width:100px; height:100px;line-height:100px;text-align:center;background-image:url(./img/empty.png);background-size:100%;font-weight: bold;font-size:2em'>";
				}else if($tables[$table]<10) {
					//printf ("<td><a href=\"table_detail.php?table=%d\"> <img src=\"./img/green.png\" width=100 height=100/><br>$table </td>", $table);
					echo "<div style='width:100px; height:100px;line-height:100px;text-align:center;background-image:url(./img/green.png);background-size:100%;font-weight: bold;font-size:2em'>";
				}else if($tables[$table]==10){
					//printf ("<td><a href=\"table_detail.php?table=%d\"> <img src=\"./img/red.png\" width=100 height=100/><br>$table </td>", $table);
					echo "<div style='width:100px; height:100px;line-height:100px;text-align:center;background-image:url(./img/red.png);background-size:100% 100%;'>";
				}else {
					echo "<div style='width:100px; height:100px;line-height:100px;text-align:center;background-image:url(./img/black.png);background-size:100% 100%;'>";
				}
				echo $table;
				echo "</div></a></td>";
				$table++;
			}
		}
		echo "<tr>";
	}
?>
</table>
</body>

</html>