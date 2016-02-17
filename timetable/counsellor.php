
<?php
	@session_start();
    if(isset($_SESSION['sess_username']))
    {
        $user=$_SESSION['sess_username'];
        $con=mysqli_connect("localhost","root","root","timetable");

    //$username = mysqli_real_escape_string($con,$user);

        $query1 = "SELECT username, pw FROM login WHERE username = '$user';";
        $query2 = "SELECT usn, pw FROM student WHERE usn = '$user';";
        $query3 = "SELECT initials, pw FROM staff WHERE initials = '$user';";

        $result1 = mysqli_query($con,$query1);
        $result2 = mysqli_query($con,$query2);
        $result3 = mysqli_query($con,$query3);
        if(mysqli_num_rows($result1) > 0)
        {
            include "navigation.php";
        }
        elseif(mysqli_num_rows($result2) > 0)
        {
            include "navigation_student.php";
        }
        else
        {
            include "navigation_teacher.php";
        }
    }
    else
    {
        include "navigation.php";
    }
      $con=mysqli_connect("localhost","root","root","timetable");
	                          date_default_timezone_set('Asia/Kolkata');
                            $timestamp = time()-86400;
                            $date = strtotime("+1 day", $timestamp);
                            $day=date('D', $date);
                            $time=date('H:i', $date);
                            $time=date('g:i', strtotime($time));
                            //$time="07:45";
							$query1 = "SELECT counsellor FROM student WHERE usn = '$user';";
							$result1 = mysqli_query($con,$query1);
							$row = mysqli_fetch_assoc($result1);
							$coun=$row["counsellor"];
              $query="SELECT * from class where sub IN (select sub from handles where name like '$coun') and CAST('$time' as time) between start_time and end_time and day='$day'";
              $result = mysqli_query($con,$query);
              if(mysqli_num_rows($result)==0)
              { if($time<"4:45" || $time>"9:00") 
                $var = "Counsellor is Free";
                else
                $var = "Not College hours";}
              else
              {
                $row = mysqli_fetch_assoc($result);
                $var = "Counsellor is taking class for sem ".$row['sem']; 
              }
              $query2="SELECT * from login where short='$coun'";
              $result2 = mysqli_query($con,$query2);
              $row2 = mysqli_fetch_array($result2);
              $email=$row2['Email'];
              $phone=$row2['Mobile'];
              $name=$row2['FName']." ".$row2['LName'];

?>
<html>

<head>
   <title>Time Table tracker</title>
</head>
<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Time Table Tracker<br>
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home Page</a>
                            </li>
							<li class="active">
                                <i class="fa fa-file"></i> Counsellor
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Counsellor Details</h3>
                    </div>
                    <div class="panel-body">
                      <?php
                      echo "<br>";
                      echo $name;
                      echo "<br>";
                      echo "<br>";
                      echo $email;
                      echo "<br>";
                      echo "<br>";
                      echo $phone;
                      echo "<br>";
                      echo "<br>";
                      echo $var;
                      ?>
                    </div>
                  </div>




 </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </body>
        <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</html>

