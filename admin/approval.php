<?php
	require_once('../auth.php');
	
	require_once('../config.php');	

	require_once('../menubar.php');
	
?>


<body  >
<script type="text/javascript" src="collapsableDiv/jquery.min.js"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type='text/Javascript'>

function toggle(id){
	var status=document.getElementById(id).checked;
	if(status==true){
		xmlhttpPost_approval("change_approve_status.php",id,true);
	}else{
		xmlhttpPost_approval("change_approve_status.php",id,false);
	}
}

  function xmlhttpPost_approval(strURL,id,status) {
	    var xmlHttpReq = false;
	    var self = this;
	    // Mozilla/Safari
	    if (window.XMLHttpRequest) {
	        self.xmlHttpReq = new XMLHttpRequest();
	    }
	    // IE
	    else if (window.ActiveXObject) {
				self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	    self.xmlHttpReq.open('POST', strURL, true);
	    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		self.xmlHttpReq.onreadystatechange = function() {
	        if (self.xmlHttpReq.readyState == 4) {
				var receivedMsg=self.xmlHttpReq.responseText;		
				//	alert(receivedMsg);
	        }
	    }
		self.xmlHttpReq.send("id="+id+"&status="+status);
	}
</script>
<style type="text/css">
.cellstyle {
	border-bottom:2px solid #44aa11;
	padding:10px;
	
}
</style>

<?php


		$sqlQuery="Select i.id,i.item_photo,i.item_name,i.item_price,i.currency,i.shop_name,i.address_id,i.timestamp,i.isApproved,a.addr_id,a.street_address,a.lat,a.lng  from item AS i,addresses AS a where i.address_id=a.addr_id ORDER BY i.timestamp DESC";	
		$resultSet=mysql_query($sqlQuery);		
		//echo $resultSet;
		
		$num=mysql_numrows($resultSet);
	
		$i=1;
		echo "<br/><p align='center' style='clear:both;padding-left:20px;padding-right:20px;'><u>APPROVAL MANAGEMENT  FOR ITEMS</u></p>";
		$str= "<table  style='width:700px;clear:both; ' cellspacing='0px' cellpadding='0px'  align='center' id='tableMain'>";
		
		while($row=mysql_fetch_object($resultSet)){
			 
			$str=$str. "<tr  id='row".$row->id."' >";
			
			if($row->isApproved=='1'){
				$str=$str."<td class='cellstyle'>"."<input type='checkbox' id='".$row->id."'  onClick='toggle(this.id);' checked=true;  />Approve Status"."</td>";
			}
			else if($row->isApproved=='0'){
				$str=$str."<td class='cellstyle'>"."<input type='checkbox' id='".$row->id."'  onClick='toggle(this.id);'   />Approve Status"."</td>";			
			}
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
		
			$i=$i+1;
		}
		
		$str=$str. "</table>";
		echo $str;
?>
</body>

<?php include('../footer.php')?> 
