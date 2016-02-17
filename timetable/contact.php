
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
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home Page</a>
                            </li>
							<li class="active">
                                <i class="fa fa-file"></i> Contacts
                            </li>
                        </ol>
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contact Details </h3>
                            </div>
                             <div class="panel-body">


<html>


<body onload="loadDoc()">


<br><br>
<p id="demo"></p>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      myFunction(xhttp);
    }
  }
  xhttp.open("GET", "data2.xml", true);
  xhttp.send();
}
function myFunction(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table="<br>";
  var x = xmlDoc.getElementsByTagName("FACULTY");
  for (i = 0; i <x.length; i++) { 
    table += x[i].getElementsByTagName("NAME")[0].childNodes[0].nodeValue +
    "<br>" +
    x[i].getElementsByTagName("DESIGNATION")[0].childNodes[0].nodeValue +
    "<br>"+
	 x[i].getElementsByTagName("PHONE")[0].childNodes[0].nodeValue +
    "<br>"+
	 x[i].getElementsByTagName("EMAIL")[0].childNodes[0].nodeValue +
    "<br><br><br><br>";
  }
  document.getElementById("demo").innerHTML = table;
}
</script>
</div></div>
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

