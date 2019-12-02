<html>

<head>
<title>Admin</title>
</head>

<body>
<?php
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `reserve_table`, COUNT(*) AS cnt FROM `employee` GROUP BY `reserve_table` ORDER BY `reserve_table`";
	
	if ($result=mysqli_query($con,$sql))
	{
		for($i=1; $i<=($result->num_rows); $i++) {
			$row=mysqli_fetch_array($result);
			echo "<h3>".$row['reserve_table'];
			echo "---------";
			echo "<a href=\"admin_list.php?table=".$row['reserve_table']."\"/>";
			if($row['cnt']>10) {
				echo '<font color="red">'.$row['cnt'].'</font>';
			}else {
				echo $row['cnt'];
			}
			echo "</a></h3>";
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>
</body>

</html>