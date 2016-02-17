<?php
    @session_start();
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
