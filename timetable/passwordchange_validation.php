<?php
ob_start();
@session_start();
$user=$_SESSION['sess_username'];
$con=mysqli_connect("localhost","root","root","timetable");

    

$query1 = "SELECT username, pw FROM login WHERE username = '$user';";
$query2 = "SELECT usn, pw FROM student WHERE usn = '$user';";
$query3 = "SELECT initials, pw FROM staff WHERE initials = '$user';";

$result1 = mysqli_query($con,$query1);
$result2 = mysqli_query($con,$query2);
$result3 = mysqli_query($con,$query3);
if(mysqli_num_rows($result1) > 0)
{
    $type=1;
}
elseif(mysqli_num_rows($result2) > 0)
{
    $type=2; 
}
else
{
    $type=3;
}


$current=$_POST['cur'];
$newpass=$_POST['new'];
$repass=$_POST['re'];

$con=mysqli_connect("localhost","root","root","timetable");


if($type==1)
{
    $query = "SELECT pw FROM login WHERE username = '$user';";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    if($row["pw"]==md5($current))
    {
        if($newpass==$repass)
        {
			$newpass1=md5($newpass);
            $query = "UPDATE login SET pw='$newpass1' where username='$user';";
            if(mysqli_query($con,$query))
            {
                echo "password change successful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }
            else
            {
                echo "password change unsuccessful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }
        }
        else
        {
            echo "New and Re-type New attributes do not match......try again";
            header('Refresh:1 ,url= password_change.php');
        }
    }
    else
    {
        echo "Password entered is incorrect......";
        header('Refresh:1 ,url= password_change.php');
    }

}
elseif($type==2)
{
    $query = "SELECT pw FROM student WHERE usn = '$user';";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    if($row["pw"]==md5($current))
    {
        if($newpass==$repass)
        {
			$newpass1=md5($newpass);
            $query = "UPDATE student SET pw='$newpass1' where usn = '$user';";
            if(mysqli_query($con,$query))
            {
                echo "password change successful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }
            else
            {
                echo "password change unsuccessful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }

        }
        else
        {
            echo "New and Re-type New attributes do not match......try again";
            header('Refresh:1 ,url= password_change.php');
        }
    }
    else
    {
        echo "Password entered is incorrect......";
        header('Refresh:1 ,url= password_change.php');
    }

}
else
{
    $query = "SELECT pw FROM staff WHERE initials = '$user';";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    if($row["pw"]==md5($current))
    {
        if($newpass==$repass)
        {
			$newpass1=md5($newpass);
            $query = "UPDATE staff SET pw='$newpass1' where initials = '$user';";
            if(mysqli_query($con,$query))
            {
                echo "password change successful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }
            else
            {
                echo "password change unsuccessful.......";
                header('Refresh:1 ,url= home_redirect.php');
            }
        }
        else
        {
            echo "New and Re-type New attributes do not match......try again";
            header('Refresh:1 ,url= password_change.php');
        }
    }
    else
    {
        echo "Password entered is incorrect......";
        header('Refresh:1 ,url= password_change.php');
    }
}
?>