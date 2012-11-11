<?php
	require_once('auth.php');
//Include database connection details
	require_once('config.php');

	include('menubar.php');
?>

<head>
<script type="text/javascript">

	var sess_member_id;

function a(){
	sess_member_id='<?=$_SESSION['SESS_MEMBER_ID'];?>';			
}

	a();

		
		
function clicked(btnID,addrID){
		
	var element=document.getElementById(btnID);
	if(element.value=="follow"){
		xmlhttpPost_saveFollow("saveFollowInDB.php",sess_member_id,addrID,true);
		element.style.backgroundColor="#33aa11";
		element.value="following";
	}else if(element.value="unfollow"){
	xmlhttpPost_saveFollow("saveFollowInDB.php",sess_member_id,addrID,false);
		element.value="follow";
		element.style.backgroundColor="";
	}
	else {
		element.value="follow";
	}
}

function mouseOver(btnID){
	var element=document.getElementById(btnID);
	if(element.value=="following"){
		element.value="unfollow";
		element.style.backgroundColor="red";
	}
}

	function mouseOut(btnID){

	var element=document.getElementById(btnID);
			if(element.value=="unfollow"){
				element.style.backgroundColor="#33aa11";
				element.value="following";
			}
		
	}
	
	function xmlhttpPost_saveFollow(strURL,user_id,address_id,followStatus) {
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
				//alert(receivedMsg);				
	        }
	    }
		self.xmlHttpReq.send("user_id="+user_id+"&address_id="+address_id+"&followStatus="+followStatus);
	}

</script>


<!--start of Map Popup Scripts-->

<link rel="stylesheet" href="http://nearmygeo.com/general.css" type="text/css" media="screen" />

<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="http://nearmygeo.com/showItems/popup.js" type="text/javascript"></script>
<script type="text/javascript"src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>	
<!--end of Map Popup Scripts-->

</head>	
	
<body>
<div id="popupContact">
		<a id="popupContactClose">x</a>
		<h1 id='popupMapTitle' style="color:#223B5B;width:100%; height:10%">Title of our cool popup, yay!</h1>
		<p id="contactArea">
			<div id="map_canvas" style="width:100%; height:80%"></div>
		</p>		
	</div>
	<div id="backgroundPopup"></div>	 
	
<?php
	
	echo "<p style='clear:both;float:left;margin-top:50px;padding-bottom:20px;font-size : 13;' ><b>Items from the <u><a href='http://www.nearmygeo.com/followLocation.php'>locations you follow</a></u> will appear on your <u><a href='http://www.nearmygeo.com/home.php'>Home</a></u> page.</b></p>";

	//locations you follow
	
	$userID=$_SESSION['SESS_MEMBER_ID'];

	
	$addrYouFollowSQL=mysql_query("SELECT a.street_address,a.addr_id,a.lat,a.lng FROM addresses AS a, follow AS f WHERE a.addr_id=f.addressID AND f.userID='$userID'");
	$id=1;
	$num=mysql_numrows($addrYouFollowSQL);
	if($num>=1)
	{
		echo  "<span  style='clear:both;display:block;border:1px solid;'>";	
		echo "<b>Locations You Follow:</b>";	
		while($r=mysql_fetch_object($addrYouFollowSQL)){
			
			$lat=$r->lat;
			$lng=$r->lng;
			$_address='"'.$r->street_address.'"';
			echo "<p style='padding-bottom:0px;padding-top:0px;'><input type='button'  id='btn".$id."' value='following' style='padding:3px;background-color:#33aa11' onClick='clicked(this.id,".$r->addr_id.")' onMouseOver='mouseOver(this.id)' onmouseout='mouseOut(this.id)'/>  &nbsp;&nbsp;"."<a class='button' href='javascript:void(0)' onClick='popupWindow($lat,$lng,$_address)'>".$r->street_address."</a></p>";
			$id++; 
		}
		echo "</span>";
		
	}
	
	//locations which you do not follow
//	echo "SESS_MEMBER_ID= ".$_SESSION['SESS_MEMBER_ID'];
echo "<br/><p style='clear:both;'><b>Follow Location</b></p>";
//Create query
	$qry="SELECT DISTINCT street_address,addr_id,lat,lng FROM addresses WHERE street_address  NOT IN (SELECT a.street_address FROM addresses AS a, follow AS f WHERE a.addr_id=f.addressID AND f.userID='$userID') ";
	$result=mysql_query($qry);
	
	while($row = mysql_fetch_array($result))
	  {
	  
		$lat=$row[lat];
		$lng=$row[lng];
		$_address='"'.$row[street_address].'"';
			
	  echo "<p style='padding-bottom:0px;padding-top:0px;'><input type='button'  id='btn".$id."' value='follow' style='padding:3px;' onClick='clicked(this.id,".$row['addr_id'].")' onMouseOver='mouseOver(this.id)' onmouseout='mouseOut(this.id)'/>  &nbsp;&nbsp;"."<a class='button' href='javascript:void(0)' onClick='popupWindow($lat,$lng,$_address)'>".$row['street_address'].'</a></p>';
	  
	  $id++;
	  }
?>


</body>