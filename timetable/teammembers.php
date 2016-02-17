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

<html>

<head>
    <title>Team Members</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Team Members
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>Team Members
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="page-header">
                    <h1>Our crew: </h1>
                </div>

                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/drcauvery.jpg" alt=""><br>
                                <h5> Dr. Cavery N K</h5>
                                <h5> Head of the department</h5>
                                <h5> Department of ISE </h5><br>
                            </div>
                        </div>
                    </div>

                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/ise_nagaraj.jpg" alt=""><br>
                                <h5> Professor Nagaraj G Cholli</h5>
                                <h5> Faculty Incharge </h5>
                                <h5> Department of ISE </h5><br>
                            </div>
                        </div>
                    </div>
                 
                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img06.jpg" alt=""><br>
                                <h5> Ganesh Arkalgud </h5>
                                <h5> 1RV11IS021 </h5>
                                <h5> gany.enthused@gmail.com </h5><br>
                            </div>
                        </div>
                    </div>
               
                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img07.jpg" alt=""><br>
                                <h5> R.Pawan Kumar </h5>
                                <h5> 1RV11IS064 </h5>
                                <h5> pawan.raviee@gmail.com </h5><br>
                                <br>
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

  

   

    



