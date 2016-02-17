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
    if(isset($_POST['teacher']))
    {
        $con=mysqli_connect("localhost","root","root","timetable");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        //connect to databse established with suitable error reporting
        @$teacher=$_POST['teacher'];

        error_reporting(E_ALL);

        /** Include path **/
        ini_set('include_path', ini_get('include_path').';../Classes/');

        /** PHPExcel */
        include 'Classes/PHPExcel.php';

        /** PHPExcel_Writer_Excel2007 */
        include 'Classes/PHPExcel/Writer/Excel2007.php';

        // Create new PHPExcel object
        $inputFileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load("PersonalTT/teacher_template.xlsx");

        //Set a new sheet with suitable name
        $newSheet = clone $objPHPExcel->getSheetByName("Sheet1");
        $newSheet->setTitle($teacher);
        $newSheetIndex = 0;
        $objPHPExcel->addSheet($newSheet,$newSheetIndex);

        // Set properties
        $objPHPExcel->getProperties()->setCreator("Ganesh and Pawan");
        $objPHPExcel->getProperties()->setLastModifiedBy("Automatic code");
        $objPHPExcel->getProperties()->setTitle("Timetable tracker");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        //save file
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save("PersonalTT/".$teacher.'.xlsx');
        header("Refresh:1,url=writer.php?teacher=".$teacher);
    }//end of isset of techer to create a new Excel file and sheet and pass to writer page
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
                            Download for teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                            
                 <form method="post" action="" enctype="multipart/form-data">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select teacher for whom the timetable should be generated:</h3>
                            </div>
                           
                            
                            
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "Downloads" folder of your browser.
                                </div>
                                <div class="form-group">
                                    <label>Teacher:</label>
                                        <select class="form-control" name="teacher">
                                            <option>Teacher Initials</option>
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
                                         <!-- PHP script to get teacher initials present in the database form handles class-->
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
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
        header('refresh:0,url=login.php');
?>