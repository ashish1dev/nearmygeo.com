<?php
//Include database connection details
	require_once('config.php');
	
	
$received_email=$_POST["email"];


	
	
	
	function isValidEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}
	
	if(isValidEmail($received_email)){
			echo "1";
			
			checkDuplicate($received_email);
	}
	else{
		echo "4";
	}

	
	function checkDuplicate($email){
		//Check for duplicate email ID
		if($email != '') {
			$qry = "SELECT * FROM registered_users WHERE email='$email'";
			$result = mysql_query($qry);
			if($result) {
				if(mysql_num_rows($result) > 0) {
					echo "2";
				}
				else{
					echo "3";
				}
				@mysql_free_result($result);
			}
			else {
				die("Query failed");
			}
		}
	}
?>