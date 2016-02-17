<?php
    
        include "navigation.php";
?>
<html lang="en">
<head>
    <title> workload_teacher </title>
</head>
<script>
    function checkAndSubmit()
    {
        
        if (document.getElementById('teacher').selectedIndex > 0)
        {
      //document.getElementById('formID').submit();
            document.getElementById('teacher-form').submit();
            
            
        }
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
                            Update Teacher's Workload
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Workload
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Teacher's Workload
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit the workload of a teacher</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="teacher-form" id="teacher-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Workload" name="work" required><br><br>
                                    <select class = "form-control" name="teacher" id="teacher">
                                        <option value=0>Choose a teacher initial</option>
                                            <?php
                                                    $con=mysqli_connect("localhost","root","root","timetable");
                                                    $query="SELECT initials from staff;";
                                                    $result=mysqli_query($con,$query);
                                                    while($row=mysqli_fetch_assoc($result))
                                                    {
                                                     echo "<option value=".$row['initials'].">".$row['initials']."</option>";
                                                    }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>                           
            </div>
                
                
                <?php
                    if(isset($_POST['teacher']))
                    {
                        //connect to database
                        $con=mysqli_connect("localhost","root","root","timetable");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            exit();
                        }

                        
                        @$teacher=$_POST['teacher'];
                        @$workload=$_POST['work'];
                        
                        if($teacher)
                        {
                            $query="UPDATE staff SET workload='$workload' WHERE initials='$teacher';";
                            $res=mysqli_query($con,$query);
                        }
                        /*?>
                        <div id="wrapper">
                            <div id="page-wrapper">
                                <div class="container-fluid">
                                    <?php
                                        if($res)
                                        {
                                            echo "Update successful.....";
                                        }
                                        else
                                        {
                                            echo "Update unsuccessful.....";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php*/
                    }
                ?>
                <script src="js/jquery.js"></script>

    
    <script src="js/bootstrap.min.js"></script>
