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
                                <i class="fa fa-file"></i> Add new teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new teacher to the department: </h3>
                            </div>
                             <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input class="form-control" name = "fn" placeholder="FN" pattern="[a-zA-Z]+" title="no numbers or special characters or space">
                                </div>
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input class="form-control" name = "ln" placeholder="LN" pattern="[a-zA-Z]+" title="no numbers or special characters or space">
                                </div>
                                <div class="form-group">
                                    <label>Initials:</label>
                                    <input class="form-control" name = "sn" placeholder="INI" pattern="[a-zA-Z]{2,3}" title="2-3 char only">
                                </div>
                                <div class="form-group">
                                    <label>Designation:</label>
                                    <input class="form-control" name = "desig" placeholder="designation" pattern="[a-zA-Z]+" title="no numbers or special characters or space">
                                </div>
                                <div class="form-group">
                                    <label>Department:</label>
                                    <input class="form-control" name = "de" placeholder="department" pattern="[A-Z]{2,3}" title="no numbers or special characters or space">
                                </div>
                                <div class="form-group">
                                    <label>Workload:</label>
                                    <input class="form-control" name = "work" placeholder="workload" pattern="[a-z]+" title="no numbers or special characters or space">
                                </div>
                                <div class="form-group">
                                    <label>Email ID:</label>
                                    <input class="form-control" name = "mail" placeholder="E-mail" type="email">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input class="form-control" name = "phone" placeholder="Phone" pattern="[7-9][0-9]{9}"  title="ten digits only">
                                </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                                  
                             </form>  
                                
                            </div>
                           
               </div>
                
                 <?php
                    if(isset($_POST['fn']))
                    {
                        //get values from form
                        $fname=$_POST['fn'];
                        $lname=$_POST['ln'];
                        $sname=$_POST['sn'];
                        $de=$_POST['desig'];
                        $workload=$_POST['work'];
                        $dept=$_POST['de'];
                        $email=$_POST['mail'];
                        $phone=$_POST['phone'];
                        $pass=md5($sname);
                        //enable connection to db and report error if failure
                        $con=mysqli_connect("localhost","root","root","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        //execute query
                        $query1="Insert into login values('$fname','$lname','$sname','NULL','NULL','$email','$phone');";
                        $result1=mysqli_query($con,$query1);
                        $query2="Insert into staff values('$sname','$fname','$lname','$de','$dept','$pass','$workload');";
                        $result2=mysqli_query($con,$query2);
                        if($result1 && $result2)
                        echo "<script> alert(\"'New teacher added'\"); </script>";
                        
                        mysqli_close($con);

                        //display message     
                    }
                ?> 
                <!-- PHP script to insert details of teacher into database -->

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