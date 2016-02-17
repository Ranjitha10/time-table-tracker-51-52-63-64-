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
   <title>Time Table tracker</title>
</head>

<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Time Table Tracker<br>
                            
                        </h1>
                        <marquee><?php
                        if(!isset($time))
                        {
                            //get current time values
                            date_default_timezone_set('Asia/Kolkata');
                            $timestamp = time()-86400;
                            $date = strtotime("+1 day", $timestamp);
                            $day=date('D', $date);
                            $time=date('H:i', $date);
                            $time=date('g:i', strtotime($time));
                            //enable connection to database
                            $con=mysqli_connect("localhost","root","root","timetable");
                            if (mysqli_connect_errno())
                            {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                exit();
                            }

                            //execute query and report failure
                            $query="SELECT * from class WHERE CAST('$time' as time) between start_time and end_time and day='$day';";
                            $result=mysqli_query($con,$query);                        
                            if($result === FALSE) 
                            {
                                die(mysql_error()); // TODO: better error handling
                            }
                    
                            else if(isset($result) and $result != FALSE)
                            {   

                                $num_rows = $result->num_rows;
                                if($num_rows>0)
                                {
                                  echo "Classes going on @ ";
                                  echo $time." - ";      
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                       echo "Sem ";
                                       echo " ".$row['sem'];
                                       echo " : ";
                                       //echo "Sub : "; 
                                       echo $row['sub']." ||";
                                       echo "<th>";
                                  } 
                                }
                                else
                            {echo "No classes are being held @ ";
                             echo $time;}
                            }
                        }
                        ?>
                               </marquee>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home Page</a>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                            <img class="img-thumbnail" src = "images/webbanner.png"></img>
                    </div>
                </div>

                    <div class="row"></div>
                    
                    <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img02.png"></img>
                                <h4>Edit</h4>
                                <h5> Easy to edit time tables as well as alert teachers just by the push of a button!</h5>
                                
                            </div>
                        </div>
                    </div>



                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img03.png"></img>
                                <h4>Download</h4>
                                <h5>Download your time tables in excel formats on the go easily.</h5>
                                
                            </div>
                        </div>
                    </div>
                 
                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img04.png"></img>
                                <h4>View</h4>
                                <h5>Time tables to see, time tables to query and time tables made easy.</h5>
                                
                            </div>
                        </div>
                    </div>
               
                 <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img class="img-thumbnail" src="images/img05.png"></img>
                                <h4>Delete</h4>
                                <h5>Clean up after use and re-create for a new semester</h5>
                                
                                <br>
                            </div>
                        </div>
                    </div>
                </div>


                               
                               
                               
                              
                 
            </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </body>
        <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</html>


                               
                             
                          
                    
                   

                    

                          

                   
                              
                           
                    
                    
                    
                    

                  
                  