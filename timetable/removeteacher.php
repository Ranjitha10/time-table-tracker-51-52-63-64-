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
   <title>Remove</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Remove
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Remove
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Remove a faculty
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                    $con=mysqli_connect("localhost","root","root","timetable");
                    if(isset($_POST['teacher']))
                    {
                        $teacher=$_POST['teacher'];
                        $query="DELETE from login where short='$teacher';";
                        $result=mysqli_query($con,$query);
                        if($result)
                        echo "Set!";    //display message;
                    }
                ?>
                <!-- PHP script to remove entries from login table in database -->
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Remove a faculty from the department: </h3>
                            </div>
                             <div class="panel-body">
                                <div class="alert alert-warning">
                                    <strong>Warning!</strong> You are removing a faculty from the department.
                                 </div>
                                <form action = "" method = "post">
                                    <div class="form-group">
                                    <div class="input-group">
                                         <select class = "form-control" name="teacher" id="teacher" onclick="checkAndSubmit()">
                                            <option value=0>Choose a faculty initial</option>
                                            <?php
                                                    $con=mysqli_connect("localhost","root","root","timetable");
                                                    $query="SELECT short from login;";
                                                    $result=mysqli_query($con,$query);
                                                    while($row=mysqli_fetch_assoc($result))
                                                    {
                                                     echo "<option value=".$row['short'].">".$row['short']."</option>";
                                                    }
                                                    mysqli_close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-danger">Remove</button>     
                             </form>  
                                
                            </div>
                           
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
    }//if not logged in redirec to login page
    else
    header('Refresh:0,url=login.php');
?>