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

<html lang="en">

<head>
    <title>Upload</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Upload
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                

                <form method="post" name="studentupload" action="studentupload-validation.php" enctype="multipart/form-data">
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for which you want to upload students:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Sem:</label>
                                        <select class="form-control" name="sem" id="sem">
                                            <option>Sem</option>
                                            <?php
                                            $con=mysqli_connect("localhost","root","root","timetable");
                                            $query="select name from sem;";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                             echo "<option value =".$row['name'].">".$row['name']."</option>";
                                            }
                                            mysqli_close($con);
                                            ?>
                                            <!-- PHP script to dynamically get values from db for sem values -->
                                        </select>
                                </div>

                              
                                <div class="form-group">
                                    <label>Select a file :</label>
                                    <input type="file" name = "file" id = "file">
                                </div>
                                

                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                </div>
                </form>
                

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
    }
    //if not logged in redirect to login page
    else
    header('Refresh:0,url= login.php');
?>