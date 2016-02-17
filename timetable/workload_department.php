<!DOCTYPE HTML>
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
    $q="SELECT SUM(MON) AS mon, SUM(TUE) AS tue, SUM(WED) AS wed, SUM(THU) as thu, SUM(FRI) as fri, SUM(SAT) as sat, AVG(total) as average, MAX(total) as max from wload;";
    $r=mysqli_query($con,$q);
    $t=mysqli_fetch_assoc($r);
    $mon=$t['mon'];
    $tue=$t['tue'];
    $wed=$t['wed'];
    $thu=$t['thu'];
    $fri=$t['fri'];
    $sat=$t['sat'];
    $max=$t['max'];
    $avg=$t['average'];
    $q="SELECT name from wload where total=".$max;
    $r=mysqli_query($con,$q);
    $t=mysqli_fetch_assoc($r);
    $name=$t['name'];

?>

<html>
<head>

  <script type="text/javascript" src="graph/canvasjs.min.js"></script>
  <script type="text/javascript">
   var mon= <?php echo $mon ?>;
   var tue= <?php echo $tue ?>;
   var wed= <?php echo $wed ?>;
   var thu= <?php echo $thu ?>;
   var fri= <?php echo $fri ?>;
   var sat= <?php echo $sat ?>;
      window.onload = function () {
        
       
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
                  {label: "saturday", y: sat }
                  ]
              }
              ]
          });
 
          chart.render();
      }
  </script>
</head>
 
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
                                <i class="fa fa-file"></i> View by department
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">WORKLOAD OF DEPARTMENT</h3>
                    </div>

                    <div class="panel-body">
                        <div id="stats">
                            <?php
                                echo "<font color=\"green\">Average workload of dept is ".$avg;
                                echo "<br>Person with highest workload is ".$name."<br></font>";
                            ?>
                         <div id="chartContainer" style="height: 500px; width: 75%;" align="center'">
                         </div>
                         <div class="table-responsive">
                          
                                <table class="table table-hover">
                                    
                                <thead>
                                    <tr>
                                        <th>Initials</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thur</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                        <th>Weekly</th>
                                    </tr>
                                </thead>
                         <?php

                              $q="SELECT * from wload";
                              $r=mysqli_query($con,$q);
                            


                              while($row = mysqli_fetch_assoc($r))
                            {
                                echo "<tr>";
                                echo "<td >" . $row['name'] . "</td>";
                                
                                echo "<td >" . $row['MON']. "</td>";
                               
                                echo "<td >" . $row['TUE'] . "</td>";
                                echo "<td >" . $row['WED'] . "</td>";
                                echo "<td >" . $row['THU'] . "</td>";
                                echo "<td >" . $row['FRI'] . "</td>";
                                echo "<td >" . $row['SAT'] . "</td>";
                                $Weekly=$row['total']-$row['other'];
                                echo "<td >" . $Weekly . "</td>";
                                echo "</tr>";

                            }
                            echo "<tr>";
                                echo "<td >"."DAYWISE-Total"."</td>";
                                
                                echo "<td >" . $mon. "</td>";
                               
                                echo "<td >" . $tue . "</td>";
                                echo "<td >" . $wed . "</td>";
                                echo "<td >" . $thu . "</td>";
                                echo "<td >" . $fri . "</td>";
                                echo "<td >" . $sat. "</td>";
                                $Weekly=$mon+$tue+$wed+$thu+$fri+$sat;
                                echo "<td >" . $Weekly . "</td>";
                                echo "</tr>";
                            
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
                          ?>
                         </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>
</html>