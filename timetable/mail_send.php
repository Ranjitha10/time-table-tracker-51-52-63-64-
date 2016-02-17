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
                        $sem=$_POST['semester'];
                        //echo $sem;
                        if ($sem == 'All')
                        {
                            $con=mysqli_connect("localhost","root","root","timetable");
                            $query = "SELECT email FROM student;";
                            $result = mysqli_query($con,$query);
                        }
                        else
                        {
                            $con=mysqli_connect("localhost","root","root","timetable");
                            $query = "SELECT email FROM student where sem='$sem';";
                            $result = mysqli_query($con,$query);
                        }
                        $recipients=array();
                        $y = 0;
                        while ($row=mysqli_fetch_assoc($result)) 
                        {
                             if(strlen($row['email'])>5)  //to eliminate cases when an entry in database does not have a mail id  
                            {
                                $recipients[$y]=$row['email'];
                                $y=$y+1;
                                /*if($y==0)
                                {
                                    $idee=$row['email'].", ";
                                    $y=$y+1;

                                }
                                else if($x==1)
                                {
                                    $idee .=$row['email'];
                                }
                                else
                                $idee .=$row['email'].", ";*/

                            }
                            
                        }
                        foreach($recipients as $email)
                        {
                                $mail->AddAddress($email);
                        }
                        //echo $idee[0]." ".$idee[1]." ".$idee[2]." ".$idee[3]." ".$idee[4]." ".$idee[5];

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
                    

?>
