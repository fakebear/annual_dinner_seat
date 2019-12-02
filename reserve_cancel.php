<html>

<head>
<title>Cancel</title>
</head>

<body>
<?php
	$wwid = $_POST["wwid"];
	echo '<h2>Cancelling reservation for '.$wwid.'</h2><br>';
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "UPDATE `employee` SET `reserve_table`=0 WHERE `WWID`=$wwid";
	
	if ($result=mysqli_query($con,$sql)) {
		echo '<h2>You just cancelled your reservation!</h2>';
	}else {
		echo '<h2>Something goes wrong. Please try again later!</h2>';
	}
?>