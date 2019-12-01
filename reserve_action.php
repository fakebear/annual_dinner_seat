<head>
<title>Table <?php echo $_GET["table"]; ?> Reservation</title>
</head>

<body>
<h1>Table <?php echo $_GET["table"]; ?> Reservation</h1>

<?php
	$table = $_POST["table"];
	$WWID = $_POST["WWID"];
	
	
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `reserve_table` FROM `employee` WHERE `WWID` = $WWID";
	
	if ($result=mysqli_query($con,$sql))
	{
		$row=mysqli_fetch_array($result);
		if($row['reserve_table']==0) {
			$sql= "UPDATE `employee` SET `reserve_table`=$table WHERE `WWID`=$WWID";
			$result=mysqli_query($con,$sql);
			echo "You successfully reserve you seat!!";
		}else {
			
		}
		// 释放结果集合
		//mysqli_free_result($result);
	}
	mysqli_close($con);
?>

</body>
</html>