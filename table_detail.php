<html>

<head>
<title>Table <?php echo $_GET["table"]; ?> Reservation</title>
</head>

<body>
<h1>Table <span style="color:red;"> <?php echo $_GET["table"]; ?> </span>Reservation</h1>
<table border=1>
<?php
	$table = $_GET["table"];
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `Name`,`WWID` FROM `employee` WHERE `reserve_table` = $table";
	
	if ($result=mysqli_query($con,$sql))
	{
		$cnt = 1;
		
		// 一条条获取
		while ($row=mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td width=80 align=\"center\">".$cnt."</td>";
			echo "<td width=100 align=\"center\">".$row["WWID"]."</td>";
			printf("<td  width=150 align=\"center\">%s</td>", $row["Name"]);
			echo "</tr>";
			$cnt++;
			
		}
		while ($cnt<=10) {
			echo "<tr>";
			echo "<td width=80 align=\"center\">".$cnt."</td>";
			echo "<td width=100></td>";
			echo "<td width=150></td>";
			echo "</tr>";
			$cnt++;
		}
		echo "</table>";
		if($result->num_rows < 10 ) {
			echo <<< eod
			<form action="reserve_action.php" name="myForm" method="post"">
			<br><br><h2>Input your WWID to reserve your seat:</h2>
			<input type="text" maxlength="8" onkeyup="this.value=this.value.replace(/\D/g,'')" name="wwid" required="required"><br>
			<input type="hidden" name="table" value="
			eod;
			echo $table;
			echo '"<br>
			<input type="submit"></br>
			</form>';
		}
		// 释放结果集合
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>
</body>
</html>