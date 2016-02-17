<?php
    ob_start();
    session_start();
    ini_set('include_path', ini_get('include_path').';../Classes/');
    include 'Classes/PHPExcel.php';
    include 'Classes/PHPExcel/Writer/Excel2007.php';
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
<html>
<head>
   <title>Download</title>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Download by semester
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by sem
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                           
                <!-- PHP script to download file if submit pressed and file exists.Else diaplay suitable message -->

                 <form method="post" action="" enctype="multipart/form-data" name="sem1">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for which you want to download timetable:</h3>
                            </div>
                             
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "Downloads" folder of your browser.
                                </div>
                                <div class="form-group">
                                    <label>Sem:</label>
                                        <select class="form-control" onchange="checkAndSubmit()" name="sem">
                                            <option value=0>Sem</option>
                                            <?php
                                            $con=mysqli_connect("localhost","root","root","timetable");
                                            $query="select distinct sem from class;";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                             echo "<option value =".$row['sem'].">".$row['sem']."</option>";
                                            }
                                            mysqli_close($con);
                                            ?>
                                        </select>
                                        <!-- PHP script to get sem values from database and from "class" table in db-->
                                </div>
                                <button type="submit" class="btn btn-default" name="download">Submit</button>
                            </div>
                        </div>
                </form>
                <?php
                                if(isset($_POST['download'])) 
                                {
                                    
                                    $sem=$_POST["sem"];
                                    $file="uploads/".$sem."sem_tt".".xlsx";
                                    if(file_exists($file)){
  
                                    header('Content-disposition: attachment; filename='.$file);
                                    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                                    header('Content-Length: ' . filesize($file));
                                    header('Content-Transfer-Encoding: binary');
                                    header('Cache-Control: must-revalidate');
                                    header('Pragma: public');
                                    ob_clean();
                                    flush(); 
                                    readfile($file);
                                    }
                                    else
                                        echo "No such file!";
                                }
                            ?>


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
    else
        header('Refresh:0,url=login.php');