<?php
	define('DB_HOST', 'localhost');
    define('DB_USER', 'tettrain');
    define('DB_PASSWORD', 'seU49T9c49');
    define('DB_DATABASE', 'tettrain_nearmygeo');
	
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

?>