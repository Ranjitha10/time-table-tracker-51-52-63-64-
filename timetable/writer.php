<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';

//Enable connection to database
$con=mysqli_connect("localhost","root","root","timetable");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

//get data from form
$teacher=$_GET['teacher'];

//query from database and show error
$teacher="%".$teacher."%";
$query="SELECT * from class where sub IN (select sub from handles where name like '$teacher')";
$result=mysqli_query($con,$query);
if($result === FALSE) 
{
	die(mysql_error()); // TODO: better error handling
}

//get details out of database
else if(isset($result) and $result != FALSE)
{						
	$num_rows = $result->num_rows;
	if($num_rows>0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$start_time=date('g:i', strtotime($row['start_time']));
			$end_time=date('g:i', strtotime($row['end_time']));
			$subject=$row['sub'];
			$day=$row['day'];
			$sem=$row['sem'];
			write_to_file($start_time,$end_time,$day,$subject,$sem); //to define a function for this
		}//end while
	}//end num_rows >0 condition
}//end set of result

//function to write to Excel file and sheet
function write_to_file($start,$end,$day,$matter,$sem)
{
	$teacher=$_GET['teacher'];
	$fname="PersonalTT/".$teacher.".xlsx";
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load($fname);
	$objPHPExcel->setActiveSheetIndex(0);
	$subject=$matter."(".$sem.")";
	switch($day)
	{
		case 'MON':$row=4;break;
		case 'TUE':$row=6;break;
		case 'WED':$row=8;break;
		case 'THU':$row=10;break;
		case 'FRI':$row=12;break;
		case 'SAT':$row=14;break;
	}

	switch($start)
	{
		case '9:00':$col='B';break;
		case '10:00':$col='C';break;
		case '11:30':$col='E';break;
		case '12:30':$col='F';break;
		case '2:15':$col='H';break;
		case '3:15':$col='I';break;
		
		//in case of 7th sem time enter values to one cell below
		case '11:15':$col='D';$row++;break;
		case '12:05':$col='E';$row++;break;
		case '12:55':$col='F';$row++;break;
		case '2:20':$col='G';$row++;break;
		case '3:10':$col='H';$row++;break;
		case '3:55':$col='I';$row++;break;
	}
	$cell=$col.$row;
	//get matches for labs and merge cells accordingly
	if(preg_match("/\(/",$matter))
	{
		$cols=$cell;
		$col++;
		$cole=$col.$row;
		$limit=$cols.":".$cole;
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($limit);
	}
	$objPHPExcel->getActiveSheet()->SetCellValue($cell,$subject);
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$fname="PersonalTT/".$teacher.".xlsx";
	$objWriter->save($fname);

	//$source = ini_get('include_path').$fname;
	//rename($source, 'C:\users\home\Downloads');
}
$teach=$_GET['teacher'];
$file="PersonalTT/".$teach.'.xlsx';
        if(file_exists($file)){
  
                                    header('Content-disposition: attachment; filename='.$file);
                                    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                                    header('Content-Length: ' . filesize($file));
                                    header('Content-Transfer-Encoding: binary');
                                    header('Cache-Control: must-revalidate');
                                    header('Pragma: public');
                                    ob_clean();
                                    flush(); 
                                    readfile($file);
                                    }
                                    else
                                        echo "No such file!";
header("Refresh:0,url=downloadteach.php");
?>
