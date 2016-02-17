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
<script>
    function checkAndSubmit()
    {
        
        if (document.getElementById('teacher').selectedIndex > 0)
        {
      //document.getElementById('formID').submit();
            document.getElementById('teacher-form').submit();
            
            
        }
    }
</script>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Classes - Teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View which teacher handles what class</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="teacher-form" id="teacher-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="teacher" id="teacher" onclick="checkAndSubmit()">
                                        <option value=0>Choose a teacher initial</option>
                                            <?php
                                                    $con=mysqli_connect("localhost","root","root","timetable");
                                                    $query="SELECT DISTINCT name from handles;";
                                                    $result=mysqli_query($con,$query);
                                                    while($row=mysqli_fetch_assoc($result))
                                                    {
                                                     echo "<option value=".$row['name'].">".$row['name']."</option>";
                                                    }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <?php
                    if(isset($_POST['teacher']))
                    {
                        //connect to database
                        $con=mysqli_connect("localhost","root","root","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        //get form data
                        @$teacher=$_POST['teacher'];
                        echo "The details for classes being taken by ".$teacher." are:<br/><br/>";
        
                        //execute query if form data is set and report failure if any
                        if($teacher)
                        {
                            $teacher="%".$teacher."%";
                            $query="SELECT * from class where sub IN (select sub from handles where name like '$teacher')";
                            $result=mysqli_query($con,$query);
                        }
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
                            $day=array("MON","TUE","WED","THU","FRI","SAT");
                            for($x=0;$x<6;$x++)
                            {
                            $query="SELECT * from class where sub IN (select sub from handles where name like '$teacher') AND day ='$day[$x]'";
                            $result=mysqli_query($con,$query);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td >" . $row['sem'] . "</td>";
                                $start=date('g:i', strtotime($row['start_time']));
                                echo "<td >" . $start. "</td>";
                                $end=date('g:i', strtotime($row['end_time']));
                                echo "<td >" . $end. "</td>";
                                echo "<td >" . $row['sub'] . "</td>";
                                echo "<td >" . $row['day'] . "</td>";
                                echo "</tr>";
                            }
                            }
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
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
                
            <!-- /.container-fluid -->
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
