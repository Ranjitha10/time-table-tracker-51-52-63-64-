 <?php
        if(isset($_POST['uname']))
        {
                        require ('class.phpmailer.php');
                        $mail = new PHPMailer(); // create a new object
                        $mail->IsSMTP(); // enable SMTP
                         // debugging: 1 = errors and messages, 2 = messages only
                        $mail->SMTPAuth = true; // authentication enabled
                        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 587; // or 465
                        $mail->IsHTML(false);
                        $mail->Username = "timetabletracker@gmail.com";
                        $mail->Password = "time2015";
                        
                        
                        
                        $user=$_POST['uname'];
                        
                        $con=mysqli_connect("localhost","root","root","timetable");
                        $query1 = "SELECT Email,pw FROM login WHERE Short = '$user';";
                        $query2 = "SELECT email FROM student WHERE usn = '$user';";
                        
                        $result1 = mysqli_query($con,$query1);
                        $result2 = mysqli_query($con,$query2);
                        
                        if(mysqli_num_rows($result1) > 0)
                        {
                            $row=mysqli_fetch_assoc($result1);
                            $email=$row['Email'];
                            $new_pass=rand()%1000000;
                            $pass=md5($new_pass);
                            if($row['pw']==NULL)
                            {
                                $query = "UPDATE staff SET pw='$pass' where initials = '$user';";
                                if(!mysqli_query($con,$query))
                                {
                                    echo "<script> alert(\"$Password change unsuccessful\"); </script>";
                                }
                            }
                            else
                            {
                                $query = "UPDATE login SET pw='$pass' where username='$user';";
                                if(!mysqli_query($con,$query))
                                {
                                    echo "<script> alert(\"$Password change unsuccessful\"); </script>";
                                }
                            }
                        }
                        else
                        {
                            $row=mysqli_fetch_assoc($result2);
                            $email=$row['email'];
                            $new_pass=rand()%1000000;
                            $pass=md5($new_pass);
                            $query = "UPDATE student SET pw='$pass' where usn = '$user';";
                            if(!mysqli_query($con,$query))
                                {
                                    echo "<script> alert(\"$Password change unsuccessful\"); </script>";
                                }
                        }
                        
                        
                        //echo "<script> alert(\"$email.' '.$new_pass\"); </script>";
                        
                        
                        
                        
                       $mail->Subject = "Password change requested for your Time Table Tracker account";
                        $mail->Body = "your new password is ".$new_pass." .Use this password to login. After logging in kindly change your password";
                        $mail->AddAddress($email);
                        
                        
                        if(!@$mail->Send())
                        {
                            echo "<script> alert(\"' Error! mail could not be sent because '.$mail->ErrorInfo\"); </script>";
                            header('Refresh:0,url= login.php');
                        }
                        else
                        {
                            echo "<script> alert(\"Mail has been Sent to your email.kindly check it for your login details\"); </script>";
                            header('Refresh:0,url= login.php');
                        }
        }
        
    
    

    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    header('Refresh:0,url=home_redirect.php');
    else
    {
    include "navigation.php";

?>

<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- Page Heading -->
                    <div class="row">
                    
                        <h1 class="page-header">
                            Forgot Password
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="home_redirect.php">Home</a>
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Forgot Password
                            </li
                        </ol>
                    </div>
                
                <!-- /.row -->
            
                
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Enter your credentials below:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form method="post" action="">
                                        <input type="text" class="form-control" placeholder="Username" name="uname" required>
                                </div>
                                <div class="form-group">
                                <button class="btn btn-default" name="check" onclick="checkAndSubmit()">Submit</button>
                                </div>
                                </form>
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
<?php
    }
?>
</html><!--End of html doc-->
        