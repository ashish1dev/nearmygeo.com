<?php
	require_once('../auth.php');

	include('../menubar.php');
	

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>image upload</title>
		
		<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
		<!-- MAKE SURE TO REFERENCE THIS FILE! -->
		<script type="text/javascript" src="scripts/ajaxupload.js"></script>
		<!-- END REQUIRED JS FILES -->
		<!-- THIS CSS MAKES THE IFRAME NOT JUMP -->

		<script type="text/javascript">
		var sess_member_id;
		
		function a(){
			sess_member_id='<?=$_SESSION['SESS_MEMBER_ID'];?>';			
		}
		
		a();
		
		</script>
		<style type="text/css">
			#upload_area iframe {
				display:none;
				
			}
		</style>
		<!-- THIS CSS MAKES THE IFRAME NOT JUMP -->
			
		<link type="text/css" href="map_css/main.css" rel="stylesheet" />
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="map_js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="map_js/jquery-ui-1.8.1.custom.min.js"></script>
		<script type="text/javascript" src="map_js/main.js"></script>
	</head>
	<body onload='a()'>
		<div id="form" >
			<!-- 
				VERY IMPORTANT! Update the form elements below ajaxUpload fields:
				1. form - the form to submit or the ID of a form (ex. this.form or standard_use)
				2. url_action - url to submit the form. like 'action' parameter of forms.
				3. id_element - element that will receive return of upload.
				4. html_show_loading - Text (or image) that will be show while loading
				5. html_error_http - Text (or image) that will be show if HTTP error.

				VARIABLE PASSED BY THE FORM:
				maximum allowed file size in bytes:
				maxSize		= 9999999999
				
				maximum image width in pixels:
				maxW			= 200
				
				maximum image height in pixels:
				maxH			= 200
				
				the full path to the image upload folder:
				fullPath		= http://tettra.in/nearmygeo/v2/addItemToLocation/uploads
				
				the relative path from scripts/ajaxupload.php -> uploads/ folder
				relPath		= ../uploads/
				
				The next 3 are for cunstom matte color of transparent images (gif,png), use RGB value
				colorR		= 255
				colorG		= 255
				colorB		= 255

				The form name of the file upload script
				filename		= filename
			-->
		
			<form action="" method="post" name="sleeker" id="sleeker" enctype="multipart/form-data" >
			<table  width="800px" valign="top" style="margin-left:5%;margin-right:5%;border-style:solid;border-width:2px;border-color:white;clear:both;" >
			<!-- THIS IS THE IMPORTANT STUFF! -->
			<tr>
				<td>
					<div id="upload_area">
						<b>Images Preview</b>
					</div>
				</td>
				<td>
					<table width="500px">
					<tr>
						<td>Item Photo:
						</td>
						<td colspan="2" align="left">
							<input type="hidden" name="maxSize" value="9999999999"  />
							<input type="hidden" name="maxW" value="200" />
							<input type="hidden" name="fullPath" value="http://nearmygeo.com/addItemToLocation/uploads/" />
							<input type="hidden" name="relPath" value="../uploads/" />
							<input type="hidden" name="colorR" value="255" />
							<input type="hidden" name="colorG" value="255" />
							<input type="hidden" name="colorB" value="255" />
							<input type="hidden" name="maxH" value="200" />
							<input type="hidden" name="filename" value="filename" />
							<input type="file" id="filename" name="filename" size="30" tabindex="1" onchange="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=name&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://nearmygeo.com/addItemToLocation/uploads/&amp;relPath=../uploads/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=200','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" /><br/>
							<small >Supported File Types: gif, jpg, png</small>
							<label id="filename_validate" style="display:none; color:red"></label>
						</td>
					</tr>
					
					<tr>
						<td>Item Name:</td>
						<td>
						<input type="text" id="itemName" name="itemName" tabindex="2" 
									style="width:70%" onKeyUp="itemName_KeyUp(event)"/>
						<label id="itemName_validate" name="itemName_validate" style="display:none;color:red;">
						</label>
						</td>
					</tr>
					
					<tr>
						<td>Price:</td>
						<td  ><input type="text" id="price" name="price" tabindex="3" style="width:20%" onKeyUp="price_KeyUp(event)"/>
						
						<select name="currency" id="currency" tabindex="4"><option value="Rs.">Rs.</option><option value="$">$</option>
						</select>						
						<label id="price_validate" name="price_validate" style="display:none;color:red;"></label>
						</td>				
					</tr>
					
					<tr>
						<td>Shop's Name:</td>
						<td><input type="text" id="shopName" name="shopName" tabindex="5" style="width:70%"/><br/>(optional)<label id="shopName_validate" name="shopName_validate" style="display:none;"></label></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<label>Nearest Address: </label><small >Locality, City, Country</small>
					<label id="address_validate" name="address_validate" style="display:none;color:red;"></label>
					<input id="nearestAddress"  type="text" tabindex="6" style="width:64%" onKeyUp="nearestAddress_KeyUp(event)"  />					
					<input type="button" id="load" name="load" tabindex="7" value="Plot on Map" onClick="loadAddress()"/>					
			<br/>
				<small >Drag Marker <img src="images/Google_Maps_Marker.png" width="22px"/>to a location which you think is the nearest to the shop's address and notice the address change below the map.</small>
				</td>				
			</tr>
			<tr >
				<td colspan="2" >					
					<div id="map_canvas" style="width:100%; height:350px"></div>
				   <!-- <label>latitude: </label><input id="latitude" type="text"/><br/>
					<label>longitude: </label><input id="longitude" type="text"/>
					-->	
					<div id="loading"  style="position:relative;top:-300px;left:250px;height:0px; ">
					<font style="background-color:#ffff21" color="GREEN" size="5" >Loading Map...</font>
					</div>
				</td>
			</tr>
			<tr valign="top" >
				<td colspan="2" align="center"><b><font size="2"  color="WHITE"><div  id='geocodedAddress' name='geocodedAddress' style="word-wrap:break-word;width:70%"></div></font></b>
				</td>
			</tr> 
			<tr>
				<td colspan="2" align="center"><input type='button' tabindex="8" onClick="save()" id="saveBtn" value="Save"/></td>
			</tr>	
			</table>
			</form>
		</div>		
</body>
</html>


<?php include('../footer.php')?> 