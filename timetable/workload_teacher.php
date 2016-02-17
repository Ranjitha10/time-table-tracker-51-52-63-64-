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
    if(isset($_POST['teacher']))
                    {
                        
                        //get form data
                        $teacher=$_POST['teacher'];
                        
        
                        //execute query if form data is set and report failure if any
                        
                            $q="SELECT * from wload where name like '$teacher'";
                            $r=mysqli_query($con,$q);
                            $res=mysqli_fetch_assoc($r);
                            $mon=$res['MON'];
                            $tue=$res['TUE'];
                            $wed=$res['WED'];
                            $thu=$res['THU'];
                            $fri=$res['FRI'];
                            $sat=$res['SAT'];
                            $oth=$res['other'];
                            $tot=$res['total'];
                            
                           }
                     ?>

<html lang="en">
<head>
    <script type="text/javascript" src="graph/canvasjs.min.js"></script>
    <script type="text/javascript">
                    var mon= <?php echo $mon ?>;
                    var tue= <?php echo $tue ?>;
                    var wed= <?php echo $wed ?>;
                    var thu= <?php echo $thu ?>;
                    var fri= <?php echo $fri ?>;
                    var sat= <?php echo $sat ?>;
                    var oth= <?php echo $oth ?>;

                   window.onload =  function () {


                    var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",//theme1
                    title:{
                        text: "DAYWISE WORKLOAD"              
                    },
                    animationEnabled: true,
                    data: [
                    {
                        type: "column",
                        dataPoints: [
                        { label: "monday", y:  mon},
                        { label: "tuesday", y: tue },
                        { label: "wednesday", y: wed },
                        { label: "thursday", y: thu },
                        { label: "friday", y: fri },
                        {label: "saturday", y: sat },
                        {label: "others", y: oth }
                        ]
                    }
                    ]
                 });
 
          chart.render();
      }
  </script>
                   
    <title> View </title>
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
                            View workload - Teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Workload
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Select Teacher</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="teacher-form" id="teacher-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="teacher" id="teacher" onclick="checkAndSubmit()">
                                        <option value=0>Choose a teacher initial</option>
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    <?php
                     if(isset($_POST['teacher']))
                            {?>
                     <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">WORKLOAD OF THE TEACHER</h3>
                    </div>

                    <div class="panel-body">
                     <div id="stats">
                            <?php
                            echo "<font color=\"green\">The details for  ".$teacher." are:<br/><br/>";
                            echo "Total workload of ".$teacher." is ".$tot."</font><br><br>";
                            }?>
                         <div id="chartContainer" style="height: 500px; width: 75%;" align="center'">
                           
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
