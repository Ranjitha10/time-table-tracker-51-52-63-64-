<?php
    ob_start();
    @session_start();
    $user=$_SESSION['sess_username'];
    $con=mysqli_connect("localhost","root","root","timetable");

    

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

<html>
<head>
    <title>Login</title>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- Page Heading -->
                    <div class="row">
                    
                        <h1 class="page-header">
                            Change Password
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Change Password
                            </li
                        </ol>
                    </div>
                
                <!-- /.row -->
            
                
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Change your Password:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form method="post" action="passwordchange_validation.php">
                                        <input type="password" class="form-control" placeholder="Current" name="cur" required>
                                </div>
                               
                                <div class="form-group">
                                        <input type="password" class="form-control" placeholder="New" name="new" required>
                                </div>

                                <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Re-type New" name="re" required>
                                </div>
                                    
                               
                                <div class="form-group">
                                <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
                                </div>
                                    </form>
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

</html><!--End of html doc-->
        