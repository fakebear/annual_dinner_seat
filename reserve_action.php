<head>
<title>Table <?php echo $_POST["table"]; ?> Reservation</title>
</head>

<body>
<h1>Table <?php echo $_POST["table"]; ?> Reservation Request</h1>

<?php
	$table = $_POST["table"];
	$WWID = $_POST["wwid"];
	
	
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `reserve_table` FROM `employee` WHERE `WWID` = $WWID";
	
	if ($result=mysqli_query($con,$sql))
	{
		if($result->num_rows >0) {
			echo "WWID record found: ".$result->num_rows."<br>";
			$row=mysqli_fetch_array($result);
			if($row['reserve_table']==0) {
				echo "no reservation now";
				//SQL update now
				$sql= "UPDATE `employee` SET `reserve_table`=$table WHERE `WWID`=$WWID";
				if($r=mysqli_query($con,$sql)) {
					echo "<h2>You successfully reserved on table: ".$table."</h2>";
				} else {
					echo "<h2>Something may goes wrong, please try again later.</h2>";
				}
			} else {
				if($row['reserve_table'] == $table) {
					echo "<h2>You have already reserved on this table.</h2>";
				} else {
					echo "You have reserved on table: ".$row['reserve_table'];
					//ask switch reservation
					$sql= "UPDATE `employee` SET `reserve_table`=$table WHERE `WWID`=$WWID";
					if($r=mysqli_query($con,$sql)) {
						printf("<h2>We have change your reservation from table: %d to table: %d</h2>",$row['reserve_table'], $table);
					} else {
						echo "<h2>Something may goes wrong, please try again later.</h2>";
					}
				}
			}
		}else {
			$row=mysqli_fetch_array($result);
			echo "You input WWID (".$WWID.") is not correct!";
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>

</body>
</html>