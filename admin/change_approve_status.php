<?php
	require_once('../config.php');	
	
$id=$_POST['id'];
$approve=$_POST['status'];
echo "approve id = ".$id;
//echo $approve;

if($approve=="true"){
	$approveSQL="update  item set isApproved=1 where id=$id;";
	 mysql_query($approveSQL); 
}
else{
	$approveSQL="update  item set isApproved=0 where id=$id;";
	 mysql_query($approveSQL); 
}



?>