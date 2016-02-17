<?php
ob_start();
session_start();
//required for start of every session

$user=$_POST['uname'];
$pas=$_POST['pass'];
$pass=md5($pas);
//required values are in the user and pass variables

$con=mysqli_connect("localhost","root","root","timetable");

//connection with db established

$username = mysqli_real_escape_string($con,$user);
$query1 = "SELECT username, pw FROM login WHERE username = '$user';";
$query2 = "SELECT usn, pw FROM student WHERE usn = '$user';";
$query3 = "SELECT initials, pw FROM staff WHERE initials = '$user';";


 
$result1 = mysqli_query($con,$query1);
$result2 = mysqli_query($con,$query2);
$result3 = mysqli_query($con,$query3);

if(mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0 && mysqli_num_rows($result3) == 0) // User not found. So, redirect to login_form again.
{
	echo "INAVLID CREDENTIALS !Redirecting to login page.Please wait....";
	header('Refresh:2,url= login.php');
}//redirect to login for failed login
else
{
	if(mysqli_num_rows($result1) != 0)
	{
		$row = mysqli_fetch_array($result1);
		if($row["username"]==$user && $row["pw"]==$pass)
		{
			echo"You are a validated user.";
			session_regenerate_id();
			
			$_SESSION['sess_user_id'] = $row['pw'];
			$_SESSION['sess_username'] = $row['username'];
			session_write_close();

			//CALCULATE WORKLOAD
			$q1="select * from staff";
			$r1=mysqli_query($con,$q1);
			while($row=mysqli_fetch_assoc($r1))
			{
				
				$day=array("MON","TUE","WED","THU","FRI","SAT");
				$wl=array(0.0,0.0,0.0,0.0,0.0,0.0);
                for($x=0;$x<6;$x++)
                {
        			$query="SELECT * from class where sub IN (select sub from handles where name = '$row[initials]') AND day ='$day[$x]'";
                	$result=mysqli_query($con,$query);
                	
                	while($res = mysqli_fetch_assoc($result))
                	{
                		$str=$res['sub'];
                		$l=strlen($str);
                		if($str[$l-1]==')')
                		{
                			$wl[$x]=$wl[$x]+3;
                		}

                		else
                		{
                			$wl[$x]=$wl[$x]+2;
                		}
                	}
                	
                }
                $st=$row['workload'];
                $len=strlen($st);
                $other=0.0;
                for($i=0;$i<$len;$i++)
                {
                	$q3="select units from workload where type='".$st[$i]."'";
                	$r3=mysqli_query($con,$q3);
                	$arr=mysqli_fetch_assoc($r3);
                	$other=$other + $arr['units'];

                }
                
                $total=$other;
                for($i=0;$i<6;$i++)
                {
                	$total=$total+$wl[$i];
                }
                $q2="select * from wload where name='".$row['initials']."'";
                $r2=mysqli_query($con,$q2);
                $rf=mysqli_fetch_assoc($r2);
                if($rf)
                	$q2="UPDATE wload SET name='".$row['initials']."',dept='".$row['dep_no']."',MON=$wl[0],TUE=$wl[1],WED=$wl[2],THU=$wl[3],FRI=$wl[4],SAT=$wl[5],other=$other,total=$total WHERE name ='".$row['initials']."'";
                else	
                	$q2="INSERT INTO wload(name, dept, mon, tue, wed, thu, fri, sat, other,total) VALUES ('$row[initials]','$row[dep_no]',$wl[0],$wl[1],$wl[2],$wl[3],$wl[4],$wl[5],$other,$total)";
                
                $r2=mysqli_query($con,$q2);
			}
		
			

			header('Refresh:0,url= index.php');
		}//redirect to index for successful login
		else
		{
			echo "Credentials not correct...Please wait";
			header('Refresh:2 ,url= login.php');
		}
	}//redirect to login for failed login

	else if(mysqli_num_rows($result2) != 0)
	{
		$row = mysqli_fetch_array($result2);
		if($row["usn"]==$user && $row["pw"]==$pass)
		{
			echo"You are a validated user.";
			session_regenerate_id();
			$_SESSION['sess_user_id'] = $row['pw'];
			$_SESSION['sess_username'] = $row['usn'];
			session_write_close();
			header('Refresh:0,url= index_student.php');
		}//redirect to index for successful login
		else
		{
			echo "Credentials not correct...Please wait";
			header('Refresh:2 ,url= login.php');
		}
	}//redirect to login for failed login

	else if(mysqli_num_rows($result3) != 0)
	{
		$row = mysqli_fetch_array($result3);
		if($row["initials"]==$user && $row["pw"]==$pass)
		{
			echo"You are a validated user.";
			session_regenerate_id();
			$_SESSION['sess_user_id'] = $row['pw'];
			$_SESSION['sess_username'] = $row['initials'];
			session_write_close();
			header('Refresh:0 ,url= index_teacher.php');
		}//redirect to index for successful login
		else
		{
			echo "Credentials not correct...Please wait";
			header('Refresh:2 ,url= login.php');
		}
	}//redirect to login for failed login
}
?>