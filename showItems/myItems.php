<?php
	require_once('../auth.php');
?>
<?php
//Include database connection details
	require_once('../config.php');

	include('../menubar.php');
?>



<script type="text/javascript" src="collapsableDiv/jquery.min.js"></script> 
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<style type="text/css">
.cellstyle {
	border-bottom:2px solid #ffffff;
	padding:10px;
	font:11px arial,sans-serif;
}
</style>

<!--start of Map Popup Scripts-->

<link rel="stylesheet" href="http://nearmygeo.com/general.css" type="text/css" media="screen" />

<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="http://nearmygeo.com/showItems/popup.js" type="text/javascript"></script>
<script type="text/javascript"src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>	
<!--end of Map Popup Scripts-->
<body  >
<div id="popupContact">
		<a id="popupContactClose">x</a>
		<h1 id='popupMapTitle' style="color:#223B5B;width:100%; height:10%">Title of our cool popup, yay!</h1>
		<p id="contactArea">
			<div id="map_canvas" style="width:100%; height:80%"></div>
		</p>		
	</div>
	<div id="backgroundPopup"></div>	 
	
<?php

$userID=$_SESSION['SESS_MEMBER_ID'];

		$sqlQuery="Select i.item_photo,i.item_name,i.item_price,i.currency,i.shop_name,i.address_id,i.timestamp,i.isApproved ,a.addr_id,a.street_address,a.lat,a.lng  from item AS i,addresses AS a where i.address_id=a.addr_id AND i.uploaded_by_user_id=$userID ORDER BY i.timestamp DESC";	
		$resultSet=mysql_query($sqlQuery);
		//echo $resultSet;
		
		$num=mysql_numrows($resultSet);
	
	if($num>=1){
			$i=1;
			
			echo "<p align='left' style='clear:both;float:left;margin-top:50px;padding-bottom:20px;font-size : 13;'><b>Items you Uploaded:</b></p>";
			
			$str= "<table  style='width:700px;clear:both; ' cellspacing='0px' cellpadding='0px'  align='left' id='tableMain'>";
			

			
			
			while($row=mysql_fetch_object($resultSet)){
				$str=$str. "<tr  id='".$i."' >";				
				if($row->isApproved==0){
					$str=$str. "<td class='cellstyle' style='color:red'>"."<u>approval pending</u>"."</td>";
				 }
				
				$str=$str. "<td class='cellstyle' >"."<img src='../addItemToLocation/uploads/".$row->item_photo."' border='0' />"."</td>";
				$str=$str. "<td class='cellstyle'>".$row->item_name."</td>";
				$str=$str. "<td class='cellstyle'>".$row->item_price." ".$row->currency."</td>";
				$shopName=$row->shop_name;
				$str=$str. "<td class='cellstyle'>".$shopName."</td>";
				$address=$row->street_address;
				$lat=$row->lat;
				$lng=$row->lng;
				//	$str=$str. "<td class='cellstyle'>"."<a target='_blank' href='http://maps.google.com?q=$lat,$lng'>".$address."</a>"."</td>";
				$_address='"'.$shopName.",".$address.'"';
				$str=$str. "<td class='cellstyle'>"."<a class='button' href='javascript:void(0)' onClick='popupWindow($lat,$lng,$_address)'>".$address."</a>"."</td>";
				$str=$str. "</tr>";
			
				$i=$i+1;
			}
			
			$str=$str. "</table>";
			echo $str;
		}
		else{
			echo "<p style='clear:both;float:left;margin-top:50px;padding-bottom:20px;font-size : 15;' align='center'> You have not uploaded any item. Share an item with your neighbours by <u>Adding Item to Location</u></p>";
		}
?>
</body>

<?php include('../footer.php')?> 