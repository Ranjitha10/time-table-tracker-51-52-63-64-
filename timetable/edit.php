<?php
    if(isset($_POST['sem']) and $_POST['time'] and $_POST['day'] and $_POST['sub'])
    {
        $sem=$_POST['sem'];
        $start=$_POST['time'];
        $day=$_POST['day'];
        $subject=$_POST['sub'];
        $link="mail_send.php?sem=".$sem."&time=".$start."&day=".$day."&sub=".$subject."";
        header('Refresh:0,url='.$link);
    }
?>

<?php
    ob_start();
    session_start();
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
?>
<head>
   <title>Edit</title>
</head>
<script>
function checkAndSubmit(a)
{
    if(document.getElementById(a).selectedIndex>0)
        document.getElementById("edit-form").submit();
    Alert("submitting form");

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
                            Edit
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit a class in the timetable:</h3>
                    </div>
                    <div class="panel-body">
                        
                        <form method="post" action="" name="edit-form" id="edit-form">
                            <div class="form-group" id="day-form">
                                <select class = "form-control" name="sem" id="sem" onchange="checkAndSubmit('sem')">
                                    <?php           
                                        $con=mysqli_connect("localhost","root","root","timetable");
                                        $query="SELECT distinct sem from class;";
                                        $result=mysqli_query($con,$query);
                                        if(isset($_POST['sem']))
                                            echo "<option value=".$_POST['sem'].">" .$_POST['sem']. "</option>";
                                        else
                                        {
                                            echo "<option value=0>Sem</option>";
                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {   
                                                 echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Select sem from database class table -->

                            <div style="display:none" class="form-group" id="day-div" name="day-div">  
                                <select class = "form-control" name="day" id="day" onchange="checkAndSubmit('day')">
                                    <?php
                                    $con=mysqli_connect("localhost","root","root","timetable");
                                    $sem=$_POST['sem'];
                                    $query="select distinct day from class where sem='$sem' ORDER BY FIELD(day,'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN');";
                                    $result=mysqli_query($con,$query);
                                    if(isset($_POST['sem']) and $_POST['day'])
                                    echo "<option value=".$_POST['day'].">" .$_POST['day']. "</option>";
                                    else
                                    {
                                        echo "<option value=0>Day</option>";
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['day'].">" . $row['day'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Select day from choices -->
                        
                            <div style="display:none" class="form-group" id="time-div" name="time-div">
                                <select class = "form-control" name="time" id="time" onchange="checkAndSubmit('time')">
                                    <?php
                                    $sem=$_POST['sem'];
                                    $day=$_POST['day'];
                                    $query="select distinct start_time from class where sem='$sem' and day='$day';";
                                    $result=mysqli_query($con,$query);
                                    if(isset($_POST['sem']) and isset($_POST['day']) and $_POST['time'])
                                    echo "<option value=".$_POST['time'].">" .$_POST['time']. "</option>";
                                    else
                                    {
                                        echo "<option value=0>Time</option>";
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['start_time'].">" . $row['start_time'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Type start time for new class -->
                        
                            <div style="display:none" class="form-group" name="sub-div" id="sub-div">
                                <select name="sub" id="sub" class = "form-control" onchange="checkAndSubmit()">
                                    <?php
                                        $sem=$_POST['sem'];
                                        $day=$_POST['day'];
                                        $time=$_POST['time'];
                                        $query="SELECT DISTINCT sub from class where sem='$sem'";
                                        $result=mysqli_query($con,$query);
                                        if(isset($_POST['sem']) and isset($_POST['day']) and isset($_POST['time']) and $_POST['sub'])
                                        echo "<option value=".$_POST['sub'].">" .$_POST['sub']. "</option>";  
                                        else
                                        {
                                            echo "<option value=0>Subject</option>";
                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                if(!preg_match("/[\(B)]/", $row['sub']))
                                                echo "<option value=".$row['sub'].">" . $row['sub'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <br/>
                                 <button class="btn btn-default" name="check">Submit</button>
                            </div>
                            <!-- Select subjects for the sem from the class table -->

    
                    </form>
                    
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
<?php
    if(isset($_POST['sem']) and !$_POST['day'])
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        </script>';
    }
    if(isset($_POST['sem']) and $_POST['day'] and !$_POST['time'])
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        document.getElementById("time-div").style.display="block";
        </script>';
    }
    if(isset($_POST['sem']) and isset($_POST['day']) and $_POST['time'] and !$_POST['sub'])
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        document.getElementById("time-div").style.display="block";
        document.getElementById("sub-div").style.display="block";
        </script>';
    }
    }//if not logged in redirect to login page
    else
    header('Refresh:0,url=login.php');
?>