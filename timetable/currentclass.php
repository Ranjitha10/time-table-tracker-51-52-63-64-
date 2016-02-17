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
?>

<html lang="en">
<head>
    <title> View </title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ongoing Classes
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Currently going on classes
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View classes being held now</h3>
                    </div>
                    <div class="panel-body">
                    <?php
                        if(!isset($time))
                        {
                            //get current time values
                            date_default_timezone_set('Asia/Kolkata');
                            $timestamp = time()-86400;
                            $date = strtotime("+1 day", $timestamp);
                            $day=date('D', $date);
                            $time=date('H:i', $date);
                            $time=date('g:i', strtotime($time));

                            //enable connection to database
                            $con=mysqli_connect("localhost","root","root","timetable");
                            if (mysqli_connect_errno())
                            {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit();
                            }

                            //execute query and report failure
                            $query="SELECT * from class WHERE CAST('$time' as time) between start_time and end_time and day='$day';";
                            $result=mysqli_query($con,$query);                        
                            if($result === FALSE) 
                            {
                                die(mysql_error()); // TODO: better error handling
                            }
                    
                            else if(isset($result) and $result != FALSE)
                            {                       
                                $num_rows = $result->num_rows;
                                if($num_rows>0)
                                {
                                    ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover">
                                    
                                    <thead>
                                    <tr>
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
                                        <th>Day</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td >" . $row['sem'] . "</td>";
                                        $start=date('g:i', strtotime($row['start_time']));
                                        echo "<td >" . $start . "</td>";
                                        $end=date('g:i', strtotime($row['end_time']));
                                        echo "<td >" . $end . "</td>";
                                        echo "<td >" . $row['sub'] . "</td>";
                                        echo "<td >" . $row['day'] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    echo "</div>";
                                    echo "</div>";
                                    //end of the tabular data display
                                }
                                else
                                    echo "No classes being held now!";
                            }
                            else
                                echo "No classes being held now";
                            mysqli_close($con);     
                        }//end of isset of time
                        @header('Refresh:300, url= currentclass.php');
                    ?>  
                    </div>
                </div>
        </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>