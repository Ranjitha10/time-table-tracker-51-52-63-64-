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
		$temp=$sem."sem_tt".".".$ext;
		$mov=move_uploaded_file($_FILES['file']['tmp_name'],"uploads/$temp");
		//save and rename files to a new folder 

		include 'Classes/PHPExcel/IOFactory.php';
		
		function get_multiple_values($cell_value,$lab_true,$first)
		{
			$inputFileType = 'Excel2007';
			$sem=$_POST["sem"];
			$fname=$_FILES['file']['name'];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$temp=$sem."sem_tt".".".$ext;
			//get file from the saved folder
						
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load("uploads/".$temp);
			$Subject=$objPHPExcel->setActiveSheetIndex(0)->getCell($cell_value)->getValue();
			
			preg_match("/[1-9]/",$cell_value,$row);//split aaccording to rows
			preg_match("/[A-Z]/",$cell_value,$col);//split aaccording to columns

			if($lab_true==true and $first==false)
			{
				$cols=$col[0]."2";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$cols=$col[0]+1;
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			//for the hours after the lab which starts half an hour late

			else if($lab_true==true and $first==true)
			{
				$cols=$col[0]."1";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$temp=$col[0];
				if($temp!='B')
				$cols=++$temp."2";
				else
				$cols="D1";
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			//for the labs itself

			else if($lab_true==false)
			{
				$cols=$col[0]."1";
				$start=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
				$cols=$col[0]."1";
				$end=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();
			}
			//for remaining non-lab hours

			$cols="A".$row[0];//direct to cell which has day value stored
			$start_time=preg_split("/-/",$start);//in the cell value get start time
			$end_time=preg_split("/-/",$end);//in the cell value get end value
	
			$Day=$objPHPExcel->setActiveSheetIndex(0)->getCell($cols)->getValue();//get day value
			if($Subject!=NULL)
			{
				$con=mysqli_connect("localhost","root","root","timetable");
				if(preg_match("/[\/]/",$Subject))
				{
					$list=preg_split("/[\/]/",$Subject);
					//electives to be split accordingly
				//	echo "Inside an elective";
					foreach($list as $sub)
					{
						$query="INSERT into class VALUES('$sem','$sub','$start_time[0]','$end_time[1]','$Day');";
						mysqli_query($con,$query);
					}
				}//end of lab subjects entry
				else if(preg_match("/[\&]/",$Subject))//indicates presence of lab Ex:SPT(B3,B4)&WP(B1,B2)
				{
					$temp=preg_split("/[\&]/",$Subject);//split according to lab Ex:SPT(B3,B4) as one entry and WP(B1,B2) as another
					foreach($temp as $base)
					{
						$list=preg_split("/[\(\,\)]/",$base);//match brackets and get lab subjects and batches added to db
						$subject=$list[0];
						$batch=$list[1];
						$batch1=$list[2];
						$Subject=$subject."(".$batch.")";
						$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
						mysqli_query($con,$query);	
						
						$Subject=$subject."(".$batch1.")";
						$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
						mysqli_query($con,$query);	
					} 
				}
				else
				{
					$query="INSERT into class VALUES('$sem','$Subject','$start_time[0]','$end_time[1]','$Day');";
					mysqli_query($con,$query);
				}
			}//end of if subject!=NULL
		}//end of function to upload subjects and time to db

//		echo "To start teacher uplods";
		$cols=array("B","C","E","F","H","I");
		$num=array("3","4","5","6","7","8");
		$first=false;
		for($j=0;$j<6;$j++)
		{
			$lab_true=false;
			for($i=0;$i<6;$i++)
			{
				if($first==true)
				{
					$first=false;
					if($i<5)
					$i++;
					else 
					continue;
				}
				$inputFileType = 'Excel2007';
				$sem=$_POST["sem"];
				$fname=$_FILES['file']['name'];
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				$temp=$sem."sem_tt".".".$ext;
				$lab_true=false;
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load("uploads/".$temp);

				$cellmax=$cols[$i]."".$num[$j];
				foreach($objPHPExcel->setActiveSheetIndex(0)->getMergeCells() as $range) 
				{
					if ($objPHPExcel->setActiveSheetIndex(0)->getCell($cellmax)->isInRange($range)) 
					{
						$lab_true=true;
						$first=true;
						break;
					}
					else
						$first=false;
				}
				get_multiple_values($cellmax,$lab_true,$first);
			}
		}

		//function to upload teacher entries into handles table from second sheet of Excel
		function teacher_uploads($num)
		{
			//set values and get uplaoded file from the stored location in server
			$inputFileType = 'Excel2007';
			$sem=$_POST["sem"];
			$fname=$_FILES['file']['name'];
			$ext = pathinfo($fname, PATHINFO_EXTENSION);
			$temp=$sem."sem_tt".".".$ext;
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load("uploads/".$temp);

			//get subject and teacher values from the file
			$sub="A".$num;
			$tea="B".$num;
			$Subject = $objPHPExcel->setActiveSheetIndex(1)->getCell($sub)->getValue();
			$Teacher = $objPHPExcel->setActiveSheetIndex(1)->getCell($tea)->getValue();
			if($Subject!=NULL && $Teacher!=NULL)
			{
				//establish a connection to database
				$con=mysqli_connect("localhost","root","root","timetable");
				if(preg_match("/Lab/",$Subject))//if Lab is detected in the cell_value get corresponding values
				{
					$lab=preg_split("/Lab/",$Subject);
					$lab[0]=trim($lab[0]);
					$temp=$lab[0];
					$temp=str_replace(' ','', $temp);// not exactly required,just a precaution
					$lab[0]=$temp;
					$temp=$lab[1];
					$temp=str_replace(' ','', $temp);// not exactly required,just a precaution
					$temp=str_replace('-','', $temp);// not exactly required,just a precaution
					$temp=str_replace(' ','', $temp);// not exactly required,just a precaution
					$lab[1]=$temp;
					$lab[1]=trim($lab[1]);
					$Subject=$lab[0]."(".$lab[1].")";
					$lab=preg_split("/[+]/",$Teacher);
					foreach($lab as $base)
					{
						//insert into database
						$query="INSERT into handles VALUES('$Subject','$base','$sem');";
						mysqli_query($con,$query);
			
					}
				}
				//insert into database
				else
				$query="INSERT into handles VALUES('$Subject','$Teacher','$sem');";
				mysqli_query($con,$query);
			}
		}

		//to write recursive code to get upload details of teachers
		
		//set values and renamed files from database
		$inputFileType = 'Excel2007';
		$sem=$_POST["sem"];
		$fname=$_FILES['file']['name'];
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		$temp=$sem."sem_tt".".".$ext;
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load("uploads/".$temp);
		$lastRow = $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();//to get size(length) of the second sheet of uploaded excel file 
		for($j=2;$j<=$lastRow;$j++)
		{
			teacher_uploads($j);//send values to the function to get the handling subjects
		}
		
		//establish connection and insert into database
		$con=mysqli_connect("localhost","root","root","timetable");
		$query="select c1.sem,c1.sub,c1.start_time,c1.end_time,c1.day,c2.start_time as start,c2.end_time as end from class as c1,class as c2 where c1.sem=c2.sem and c1.sub=c2.sub and c1.start_time=c2.end_time and c1.day=c2.day;";
		$result1=mysqli_query($con,$query);
		if($result1 === FALSE) 
	{
		die(mysqli_error()); // TODO: better error handling
	}
	//combine values in case of seperate hours placed next to each other		
	if(isset($result1) and $result1 != FALSE)
	{	
		$num_rows = $result1->num_rows;
		if($num_rows>0)
		{
			while($row=mysqli_fetch_assoc($result1))
			{
				$sem=$row['sem'];
				$sub=$row['sub'];
				$old_beg=$row['start_time'];
				$new_end=$row['end_time'];
				$day=$row['day'];
				$new_beg=$row['start'];
				$old_end=$row['end'];
			$query1="delete from class where sem='$sem' and sub='$sub' and start_time='$old_beg' and end_time='$new_end' and day='$day';";
				$result2=mysqli_query($con,$query1) or die(mysql_error());
			$query1="delete from class where sem='$sem' and sub='$sub' and start_time='$new_beg' and end_time='$old_end' and day='$day';";
				$result2=mysqli_query($con,$query1) or die(mysql_error());
			$query1="insert into class values('$sem','$sub','$new_beg','$new_end','$day');";
				$result2=mysqli_query($con,$query1) or die(mysql_error());
			}
		}
	}
	}
	echo "Updating database...Please wait.";
	header('Refresh:1,url= home_redirect.php');
?> 