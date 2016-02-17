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
            header('Refresh:0,url= index.php');
        }
        elseif(mysqli_num_rows($result2) > 0)
        {
            header('Refresh:0,url= index_student.php');
        }
        else
        {
            header('Refresh:0,url= index_teacher.php');
        }
    }
    else
    {
        header('Refresh:0,url= index.php');
    }
?>