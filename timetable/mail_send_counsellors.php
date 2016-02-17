<?php
    
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
                        //$mail->WordWrap = 50;
                        $mail->Subject = $_POST['name'];
                        $mail->Body = $_POST['message'];
                       
                        //echo $sem;
                         @session_start();
                        if(isset($_SESSION['sess_username']))
                        {
                            $user=$_SESSION['sess_username'];
                            //echo "<script> alert(\"$user\"); </script>";
                            $con=mysqli_connect("localhost","root","root","timetable");
                            $query = "SELECT email FROM student where counsellor = '$user';";
                            $result = mysqli_query($con,$query);
                            $mail->FromName = $user."(counsellor)";
                        
                       
                        $recipients=array();
                        $y = 0;
                        while ($row=mysqli_fetch_assoc($result)) 
                        {
                             if(strlen($row['email'])>5)  //to eliminate cases when an entry in database does not have a mail id  
                            {
                                $recipients[$y]=$row['email'];
                                $y=$y+1;
                                
                            }
                            
                        }
                        foreach($recipients as $email)
                        {
                                $mail->AddAddress($email);
                        }
                        //echo $recipients[0];

                        //$idee="'".$idee."'";
                        //$mail->AddAddress($idee);
                        if(!@$mail->Send())
                        {
                            echo "<script> alert(\"' Error! mail could not be sent because '.$mail->ErrorInfo\"); </script>";
                            header('Refresh:1,url= index.php');
                        }
                        else
                        {
                            echo "<script> alert(\"Message Sent\"); </script>";
                            header('Refresh:1,url= index.php');
                        }
                    }
                    

?>
