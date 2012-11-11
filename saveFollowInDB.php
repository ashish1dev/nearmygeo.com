<?php
include 'config.php';


$userID=$_POST['user_id'];
$addressID=$_POST['address_id'];
$followStatus=$_POST['followStatus'];


//echo $userID.','.$addressID.','.$followStatus;

if($followStatus=="true"){
	$followSQL=mysql_query("INSERT INTO follow (userID,addressID) VALUES ('$userID','$addressID')");
	if(!$followSQL){
		echo mysql_error();
	}
	else{
		echo '1';
	}
}
else if($followStatus=="false"){
	$deleteFollowSQL=mysql_query("DELETE FROM follow WHERE userID='$userID' AND addressID='$addressID'");
	if(!$deleteFollowSQL){
		mysql_error();
	}
	else{
		echo '2';
	}
}
?>