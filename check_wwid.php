<html>
<?php
	$wwid = $_POST["wwid"];
	$con = new mysqli("localhost","root","", "annual_dinner_2019");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysqli_select_db($con, "annual_dinner_2019");
	$sql = "SELECT `reserve_table` FROM `employee` WHERE `WWID` = $wwid";
	
	if ($result=mysqli_query($con,$sql)) {
        $row = mysqli_fetch_array($result);
        $table = $row["reserve_table"];
    }
?>
<head>
<title>Table <?php echo $table ?> Reservation</title>
</head>

<body>

<table border=1>
<?php
    if($table == 0) {
        echo "<h1>This WWID didn't reserve any seat!</h1>";
    } else {
        echo "<h1>Table <span style=\"color:red;\">".$table." </span>Reservation</h1>";
        $sql = "SELECT `Name`,`WWID` FROM `employee` WHERE `reserve_table` = $table";
        
        if ($result=mysqli_query($con,$sql))
        {
            $cnt = 1;
            
            // 一条条获取
            while ($row=mysqli_fetch_array($result))
            {
                echo "<tr>";
                
                echo "<td width=80 align=\"center\">".$cnt."</td>";
                if($row["WWID"]==$wwid) {
                    echo "<td width=100 align=\"center\" bgcolor=\"red\">".$row["WWID"]."</td>";
                } else {
                    echo "<td width=100 align=\"center\">".$row["WWID"]."</td>";
                }
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
        }
        echo '<form action="reserve_cancel.php" method="post">';
        echo '<input type="hidden" name="wwid" value="'.$wwid.'">';
        echo '<input type="submit" value="Cancel My Reservation"></br>';
        echo '</form>';
    }
    // 释放结果集合
    mysqli_free_result($result);
	mysqli_close($con);
?>
</body>
</html>