<?php
	require_once('../auth.php');
	
	require_once('../config.php');	

	include('../menubar.php');
?>
<html>
<head>



<script type="text/javascript" src="collapsableDiv/jquery.min.js"></script> 
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<style type="text/css">
.cellstyle {
	border-bottom:2px solid #44aa11;
	padding:10px;
}
</style>


<!--start of Map Popup Scripts-->

<link rel="stylesheet" href="http://nearmygeo.com/general.css" type="text/css" media="screen" />

<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script type="text/javascript"src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="http://nearmygeo.com/showItems/popup.js" type="text/javascript"></script>
<!--end of Map Popup Scripts-->
</head>
<body>

<?php


		$sqlQuery="Select i.item_photo,i.item_name,i.item_price,i.currency,i.shop_name,i.address_id,i.timestamp,a.addr_id,a.street_address,a.lat,a.lng  from item AS i,addresses AS a where i.isApproved=1 AND i.address_id=a.addr_id ORDER BY i.timestamp DESC";	
		$resultSet=mysql_query($sqlQuery);		
		//echo $resultSet;
		
		$num=mysql_numrows($resultSet);
	
		$i=1;
		echo "<p  style='clear:both;float:left;margin-top:50px;padding-bottom:20px;font-size : 13;'><b>All Items List:</b></p>";
	//	$str= "<table  style='width:700px;clear:both; ' cellspacing='0px' cellpadding='0px'  align='center' id='tableMain'>";
		
		while($row=mysql_fetch_object($resultSet)){
			 
		/*	$str=$str. "<tr  id='".$i."' >";
			$str=$str. "<td class='cellstyle' >"."<img src='../addItemToLocation/uploads/".$row->item_photo."' border='0' />"."</td>";
			$str=$str. "<td class='cellstyle'>".$row->item_name."</td>";
			$str=$str. "<td class='cellstyle'>".$row->item_price." ".$row->currency."</td>";
			$shopName=$row->shop_name;
			$str=$str. "<td class='cellstyle'>".$shopName."</td>";
			$address=$row->street_address;
			$lat=$row->lat;
			$lng=$row->lng;
				$str=$str. "<td class='cellstyle'>"."<a target='_blank' href='http://maps.google.com?q=$lat,$lng'>".$address."</a>"."</td>";
			$str=$str. "</tr>";
		*/ 
		$address=$row->street_address;
		$lat=$row->lat;
		$lng=$row->lng;
//		$str=$str."<a href='http://maps.google.com?q=$lat,$lng'"." target='_blank' title='$row->item_name' //style='display:inline-block;width:750px;height:200px;padding-bottom:10px;padding-top:10px;clear:both;float:left;ov//erflow:hidden;text-decoration:none;font:11px arial,sans-serif;' valign='middle'>;
		
$str=$str."<span style='clear:both;float:left;width:750px'>";

$str=$str."<span style='display:inline-block;clear:both;float:left;padding:5px;width:200px;height:200px;overflow:hidden;font:11px arial,sans-serif;' ><img src='../addItemToLocation/uploads/$row->item_photo' valign='middle' border='0'  />
</span>
<span style='display:inline-block;float:left;padding-left:5px;padding-right:5px;width:100px;height:200px;vertical-align:middle;font:11px arial,sans-serif;' >
<table style='height:180px;vertical-align:middle;font:11px arial,sans-serif;'>
<tr>
<td>
$row->item_name
</td>
</tr>
</table>
</span>
<span style='display:inline-block;float:left;padding-left:5px;padding-right:5px;width:100px;height:200px;font:11px arial,sans-serif;'>
<table style='height:180px;vertical-align:middle;font:11px arial,sans-serif;'>
<tr>
<td >$row->item_price $row->currency</td>
</tr>
</table>
</span>

<span style='display:inline-block;float:left;padding-left:5px;padding-right:5px;width:100px;height:200px;word-wrap:break-word;font:11px arial,sans-serif;'>
<table style='height:180px;vertical-align:middle;font:11px arial,sans-serif;'>
<tr>
<td >$row->shop_name</td>
</tr>
</table>
</span>
<span style='display:inline-block;float:left;padding-left:5px;padding-right:5px;width:200px;height:200px;word-wrap:break-word;font:11px arial,sans-serif;'>
<table style='height:180px;vertical-align:middle;font:11px arial,sans-serif;'>
<tr>";

//<a href='http://maps.google.com?q=$lat,$lng'"." target='_blank' title='$row->item_name'>
//$row->street_address
$_address='"'.addcslashes($row->shop_name,"'").",".$address.'"';
	$str=$str."<td><a class='button' href='javascript:void(0)' onClick='popupWindow($lat,$lng,$_address)'>".$address."</a>"."</td>";
				
$str=$str."</a>
</td>
</tr>
</table>
</span>";

$str=$str."</span>";

$str=$str."<span style='display:inline-block;clear:both;float:left;width:750px;height:0px;padding:0px; border-top:2px solid white;font:11px arial,sans-serif;'></span>";
		
		 
			$i=$i+1;
		}
		
	//	$str=$str. "</table>";
		echo $str;
?>


		
	<div id="popupContact">
		<a id="popupContactClose">x</a>
		<h1 id='popupMapTitle' style="color:#223B5B;width:100%; height:10%">Title of our cool popup, yay!</h1>
		<p id="contactArea">
			<div id="map_canvas" style="width:100%; height:80%"></div>
		</p>		
	</div>
	<div id="backgroundPopup"></div>	
		
<?php include('../footer.php')?> 
</body>
</html>