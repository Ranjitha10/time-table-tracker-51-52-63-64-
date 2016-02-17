<?php
	$sem=$_POST["sem"];
	$fname=$_FILES['file']['name'];
	if(!isset($fname))
	{
		echo "File not able to upload!Please try again!";
	}
	else if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} 
	else 
	{
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		$temp=$sem."student".".".$ext;
		$mov=move_uploaded_file($_FILES['file']['tmp_name'],"uploads/$temp");
		//save and rename files to a new folder 
		

		include 'Classes/PHPExcel/IOFactory.php';
		
			$inputFileType = 'Excel2007';
			$sem=$_POST["sem"];
			$fname=$_FILES['file']['name'];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$temp=$sem."student".".".$ext;
			//get file from the saved folder
						
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load("uploads/".$temp);

			$sheet = $objPHPExcel->setActiveSheetIndex(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();
			$x=1;
			$con=mysqli_connect("localhost","root","root","timetable");
			//$stmt=$con->prepare("INSERT into student(usn, dept, name, counsellor, sem, pw) values(?,?,?,?,?,?)");
			//$stmt->bind_param("ssssss",$usn,$dept,$name,$counsellor,$sem,$pw);
			
			while($x<=$highestRow)
			{	$l="A".$x;
				$m="B".$x;
				$n="C".$x;
				$o="D".$x;
				$p="E".$x;
				$q="F".$x;
				$r="G".$x;
				
				$usn=$sheet->getCell($l)->getValue();
				$dept=$sheet->getCell($m)->getValue();
				$name=$sheet->getCell($n)->getValue();
				$counsellor=$sheet->getCell($o)->getValue();
				$email=$sheet->getCell($p)->getValue();
				$phone=$sheet->getCell($q)->getValue();
				$sem=$sheet->getCell($r)->getValue();
				$pass=md5($usn);
				//echo $usn."\n".$name;
				//$stmt->execute();
				$query="INSERT into student values('$usn','$dept','$name','$counsellor','$email','$phone','$sem','$pass');";
				mysqli_query($con,$query);
				$x=$x+1;
				//echo $x;
			}
			

	}
	echo "Updating database...Please wait.";
	header('Refresh:1,url= home_redirect.php');
?> 