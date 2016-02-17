<?php
	//start of sessions and connection to db
	ob_start();
	session_start();
	$con=mysqli_connect("localhost","root","root","timetable");

	//query to delete values from "class" table in db and sotre a dump file
	$query="DELETE from class where 1;";
	mysqli_query($con,$query);
	$tableName  = 'class';
	$backupFile = 'backup/class.sql';
	$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
	$result = mysqli_query($con,$query);

	//query to delete values from "handles" table in db and store a dump file
	$query="DELETE from handles where 1;";
	mysqli_query($con,$query);
	$tableName  = 'handles';
	$backupFile = 'backup/handles.sql';
	$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
	$result = mysqli_query($con,$query);
	header('Refresh:1,url=home_redirect.php');
//	bool unlink ( string $filename [, resource $context ] )
?>