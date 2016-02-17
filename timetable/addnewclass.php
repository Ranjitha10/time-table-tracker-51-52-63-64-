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
   <title>Add</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
               
                 <?php
                    if (isset($_POST['sem']) and isset($_POST['strength'])) 
                    {
                    
                        //get values from form
                        $class=$_POST['sem'];
                        $str=$_POST['strength'];

                        //get connection with dtaabase
                        $con=mysqli_connect("localhost","root","root","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }
                        
                        //execute query
                        $query="Insert into sem values('$class','$str');";
                        $result=mysqli_query($con,$query);
                        mysqli_close($con);
                        //display message
                    }
                ?>
                <!-- PHP script to insert a new class and sectio nto database -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Add
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Add new class
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new class to the department: </h3>
                            </div>
                            <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                    <label>Enter sem and section</label>
                                    <input class="form-control" name = "sem" placeholder="Sem and section">
                                </div>
                                <div class="form-group">
                                    <label>Enter Strength of the new class</label>
                                    <input class="form-control" name = "strength" placeholder="Strength">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
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
    }//if not logged in redirec to login page
    else
    header('Refresh:0,url=login.php');
?>