<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FULL_NAME']);
	unset($_SESSION['SESS_EMAIL']);
	session_destroy();
	header("location: index.php");
	
?>
