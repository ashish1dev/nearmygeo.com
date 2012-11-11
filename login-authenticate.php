<?php
	//Start session
	session_start();
	
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
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	
	//echo $email.",".$password;
	
	//Create query
	$qry="SELECT * FROM registered_users WHERE email='$email' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
		//Login Successful
				session_regenerate_id();
				$member = mysql_fetch_assoc($result);
			if($member['activation']==''){				
				$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
				$_SESSION['SESS_FULL_NAME'] = $member['fullname'];
				$_SESSION['SESS_EMAIL'] = $member['email'];
				session_write_close();
				echo '1';
			}
			else if($member['activation']!='') {
				echo '3';
			}
		}else {
			//Login failed
			echo '2';			
		}
	}else {
		die("Query failed");		
	}
?>