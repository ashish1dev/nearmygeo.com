<?php
//Include database connection details
	require_once('../../config.php');
	
	

	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
include "time_ago.php";

		$sqlQuery="Select * from item";	
		$resultSet=mysql_query($sqlQuery);		
		//echo $resultSet;
		
		$num=mysql_numrows($resultSet);
	
		$i=1;
		$str="";
		while($row=mysql_fetch_row($resultSet)){
			
			$str=$str."<div class='cell' style='float:left;white-space: nowrap;'> <br/><a href='javascript:void(0)'><img border='8px' src='http://localhost/php_ajax_image_upload/uploads/".$row[1]."'  /></a>".
			"<br/><b>".$row[2]."</b>&nbsp;&nbsp;Rs.".$row[3]."<br/>".$row[4]."<br/><b>".$row[5]."</b><br/>".TimeAgo(strtotime($row[8]),-1)."</div>";
			
			
		}

		echo $str;

		?>

