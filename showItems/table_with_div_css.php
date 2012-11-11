
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</HEAD>
	<style>
	.round{
		border-radius:2em;
		background-color:#ffffff; 
		border:solid #c7a1ec 2px;
		margin:10px;		
		-webkit-border-top-left-radius: 9px;
		-moz-border-radius-topleft: 9px;
		-webkit-border-top-right-radius: 9px;
		-moz-border-radius-topright: 9px;
		-webkit-border-bottom-left-radius: 9px;
		-moz-border-radius-bottomleft: 9px;
		-webkit-border-bottom-right-radius: 9px;
		-moz-border-radius-bottomright: 9px;	

 -moz-border-radius:10px;
-webkit-border-radius:10px;
 behavior:url(border-radius.htc);	
	}
	
	.cell{
		word-wrap:break-word;
		width:47.5%;
		height:300px;
		background-color:#f0e4fa;
		border:solid #c7a1ec 1px;
		margin-left:9px;
		margin-top:9px;
		margin-bottom:9px;
		
		-webkit-border-top-left-radius: 9px;
		-moz-border-radius-topleft: 9px;
		-webkit-border-top-right-radius: 9px;
		-moz-border-radius-topright: 9px;
		-webkit-border-bottom-left-radius: 9px;
		-moz-border-radius-bottomleft: 9px;
		-webkit-border-bottom-right-radius: 9px;
		-moz-border-radius-bottomright: 9px;
		
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		behavior:url(border-radius.htc);	
	}
	</style>
	<script type="text/javascript">
	function getItemsData(){
		xmlhttpPost("getItemsFromDB.php");
	}
	
	function xmlhttpPost(strURL) {
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
				updatepage(self.xmlHttpReq.responseText);
			}
		}	
		self.xmlHttpReq.send("");
	}
	
	function updatepage(str){
		//alert(str);		
		document.getElementById("content").innerHTML=str;
	}
	</script>
	<body onload="getItemsData();" style="white-space: nowrap;">
	
		<div align="center">
			<label for="search">Search:</label><input type="text" id="search" name="search" />
		</div>
		<DIV id="lt" 	class="round"  style="float:left;width:15%;" align='center'>
			<li>jijij</li><li>jijij</li><li>jijij</li><li>jijij</li>
		</DIV>
		<div id="content" 	class="round"  style="float:left;width:60%;" align="center">
		
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>			
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
		
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			<div style="float:left" class="cell"> TR			</div>
			
		</div>

		<DIV id="rt" class="round"  style="float:left;width:15%;" align="center">
			<p>jdiji</p>
		</DIV>


    </body>
</html>