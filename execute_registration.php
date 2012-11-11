<?php

	
	//Include database connection details
	require_once('config.php');
	
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values

	$fullname=clean($_POST['fullname']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	
	// Create a unique  activation code:
	$activation = md5(uniqid(rand(), true));
	$from_email="NearMyGeo.com <contact@nearmygeo.com>";
	
	//Create INSERT query
	$qry = "INSERT INTO registered_users(fullname, email, passwd,activation) VALUES('$fullname','$email','".md5($_POST['password'])."','$activation')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		if (mysql_affected_rows($link) == 1) { //If the Insert Query was successfull.
	 
	                // Send the email:
						$message = "Thank you for registering with NearMyGeo.com.\n\n To activate your account, please click on this link:\n\n";
						$message .= 'http://www.nearmygeo.com' . '/activation.php?email=' . urlencode($email) . "&key=$activation";
						mail($email, 'Registration Confirmation', $message, 'From:'.$from_email);	
					
					echo "1";	 
	            } else { // If it did not run OK.
	                //echo 'You could not be registered due to a system error. We apologize for any inconvenience.';
					echo "2";
	            }	         
	}else {
		die("Query failed");
	}
?>