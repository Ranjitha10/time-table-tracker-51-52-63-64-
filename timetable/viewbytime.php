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
                            View Classes - Time
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by time
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View courses by time</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <div class = "input-group">
                                    <label>Enter Time of the day:</label>
                                    <input class="form-control" placeholder="Enter time (Eg: 9:00)" id="time" name="time">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label> Select a semester : </label>
                                    <select class = "form-control" name="sem" id="sem" onclick="checkAndSubmit()">
                                    <option value=0>Semester</option>
                                        <?php                   
                                             $con=mysqli_connect("localhost","root","root","timetable");
                                             $query="SELECT distinct sem from class;";
                                             $result=mysqli_query($con,$query);

                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                             }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"> 
                                <div class="input-group"> 
                                        <label> Select a day of the week: </label>
                                            <select class = "form-control" name="day" id="day" onclick="checkAndSubmit()">
                                                <option value=0>Day</option>
                                                <option value="MON">MON</option>
                                                <option value="TUE">TUE</option>
                                                <option value="WED">WED</option>
                                                <option value="THU">THU</option>
                                                <option value="FRI">FRI</option>
                                                <option value="SAT">SAT</option>
                                            </select>
                                </div>
                            </div>  
                            <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
                        </div>
                    </div>
                    </form>
                 </div>
            <!-- /.container-fluid -->
                <?php
                    if(isset($_POST['time']) || isset($_POST['day']) || isset($_POST['sem']))
                    {
                        //connect to database
                        $con=mysqli_connect("localhost","root","root","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }
                        
                        //get data from form
                        @$time1=$_POST['time'];
                        @$day1=$_POST['day'];
                        @$sem1=$_POST['sem'];

                        //if all of the time day and sem are set
                        if($time1 and $day1 and $sem1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1' and sem='$sem1'; ";
                            $result=mysqli_query($con,$query);
                        }

                        //if only time and day are set
                        else if($time1 and $day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1';";
                            $result=mysqli_query($con,$query);
                        }
                        
                        //if only time and sem are set
                        else if($time1 and $sem1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where CAST('$time1' as time) BETWEEN start_time and end_time and sem='$sem1'; ";
                            $result=mysqli_query($con,$query);
                        }
                        
                        //if only sem and day are set
                        else if($sem1 and $day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where day='$day1' and sem='$sem1'; ";
                            $result=mysqli_query($con,$query);
                        }
        
                        //else if onyl day is set
                        else if($day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.sub,c.day from class as c where day='$day1'; ";
                            $result=mysqli_query($con,$query);
                        }
        
                        //error reporting
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
                                    echo "<td >" . $row['start_time'] . "</td>";
                                    echo "<td >" . $row['end_time'] . "</td>";
                                    echo "<td >" . $row['sub'] . "</td>";
                                    echo "<td >" . $row['day'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            else
                            echo "No entries!";
                        }
                        else
                        echo "No entries!";
                        mysqli_close($con); 
                    }
                    else
                    {
                    ?> 

               
            <?php
            }
            ?>
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