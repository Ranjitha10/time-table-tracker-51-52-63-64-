<?php
    
        $con=mysqli_connect("localhost","root","root","timetable");
		$query1 = "SELECT * FROM login ";
		$query2 = "SELECT * FROM student ";
        $query3 = "SELECT * FROM staff ";
		
		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
        $result3 = mysqli_query($con,$query3);
		
		while($row1 = mysqli_fetch_assoc($result1))
        {
        	if(strlen($row1['pw'])>1)
			{
			$user=$row1['Short'];
			$pass3=($row1['pw']);
			$pass1=md5($pass3);
			$query4 = "UPDATE login SET pw = '$pass1' WHERE Short = '$user';";
			$result4 = mysqli_query($con,$query4);}
		}
		while($row2 = mysqli_fetch_assoc($result2))
        {
        	if(strlen($row2['pw'])>1)
			{
			$pass2=md5($row2['pw']);
			$pass3=$row2['usn'];
			
			$query5 = "UPDATE student SET pw = '$pass2' WHERE usn = '$pass3';";
				$result5 = mysqli_query($con,$query5);
			}
			
		}
		while($row3 = mysqli_fetch_assoc($result3))
        {
        	if(strlen($row3['pw'])>1)
			{
			$pass4=md5($row3['pw']);
			$pass3=$row3['initials'];
			
			$query5 = "UPDATE staff SET pw = '$pass4' WHERE initials = '$pass3';";
				$result6 = mysqli_query($con,$query5);
			}
		}
		/*$query4 = "UPDATE login SET pw = '$pass1' WHERE pw = $row1['pw']";
		$query5 = "SELECT pw FROM student WHERE usn = '$user';";
        $query6 = "SELECT pw FROM staff WHERE initials = '$user';";
		
		$result1 = mysqli_query($con,$query2);
		$result2 = mysqli_query($con,$query2);
        $result3 = mysqli_query($con,$query3);*/
	?>