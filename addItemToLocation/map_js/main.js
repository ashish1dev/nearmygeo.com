//Useful links:
// http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
// http://code.google.com/apis/maps/documentation/javascript/services.html#Geocoding
// http://jqueryui.com/demos/autocomplete/#remote-with-cache
      
	var geocoder;
	var map;
	var marker;
	var mapLoaded=false;
	
	function initialize(){
		//MAP
		//bangalore latitude = 12.9715987,longitude = 77.59456269999998
		  var latlng = new google.maps.LatLng(12.9715987,77.59456269999998);
		  var options = {
			zoom: 14,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE
			},

			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			minZoom:14
		  };				
		  map = new google.maps.Map(document.getElementById("map_canvas"), options);				
		  
			google.maps.event.addListener(map, "dragstart", function() {
				document.getElementById("loading").style.display="";
			});
		 
		  google.maps.event.addListener(map,'tilesloaded',function(){			
			mapLoaded=true;
		//	alert("all tiles loaded !");
		//	document.getElementById("loading").innerHTML="";
			document.getElementById("loading").style.display="none";
		  });
		
		

		  //GEOCODER
		  geocoder = new google.maps.Geocoder();				
		  marker = new google.maps.Marker({
			map: map,
			draggable: true
		  });
		  
		  
	}
		
	
	var previousAddressText='';
	
	function loadAddress(){
		if(mapLoaded==true){
			var addressText=trim(document.getElementById('nearestAddress').value);		
			
			
			if(addressText.length>0){
				document.getElementById("geocodedAddress").innerHTML="Loading...";
				geocoder.geocode( {'address': addressText }, function(results, status) {			
					if (status == google.maps.GeocoderStatus.OK) {
						if(results.length>0){
							var location = results[0].geometry.location;	
								addressText=results[0].formatted_address;
					//	alert(previousAddressText+","+addressText);
								google.maps.event.addListener(map,'center_changed',function(){						
									//alert("center changed !");	
									if(addressText!=previousAddressText){
										document.getElementById("loading").style.display="";
								
									}									
								});
							
								google.maps.event.addListener(map,'tilesloaded',function(){
									//alert("all tiles loaded !");							
								if(addressText!=previousAddressText){
								
										document.getElementById("loading").style.display="none";
								
								}
								});
								previousAddressText=addressText;
							
							marker.setPosition(location);
							map.setCenter(location);
							map.setZoom(16);	
							//get lat lng of marker position;
							get_typed_address_latlng();
							
						document.getElementById("geocodedAddress").innerHTML=results[0].formatted_address;
							
						}
					}
					else{
						//alert("re-check the address you entered. It seems incorrect.");
						document.getElementById("address_validate").style.display="";
						document.getElementById("address_validate").innerHTML="re-check the address you entered. It seems incorrect.";
					}
				});
			}
			else{
				//alert("Finding a blank address is not easy !! Please enter an adddress and make our task easier :)");
				document.getElementById("address_validate").style.display="";
				document.getElementById("address_validate").innerHTML="Finding a blank address is not easy !! Please enter an adddress and make our task easier :)";
				document.getElementById("geocodedAddress").innerHTML="";
			}
		}
		else{
			alert('Map still loading...');
		}
	}
	
		
	var latitude="";
	var longitude="";
	
$(document).ready(function() {
         
  initialize();
				  
  $(function() {
    $("#nearestAddress").autocomplete({
      //This bit uses the geocoder to fetch address values
      source: function(request, response) {
        geocoder.geocode( {'address': request.term }, function(results, status) {
          response($.map(results, function(item) {
            return {
              label:  item.formatted_address,
              value: item.formatted_address,
              latitude: item.geometry.location.lat(),
              longitude: item.geometry.location.lng()
            }
          }));
        })
      },
      //This bit is executed upon selection of an address
      select: function(event, ui) {
      //  $("#latitude").val(ui.item.latitude);
       // $("#longitude").val(ui.item.longitude);
		latitude=ui.item.latitude;
		longitude=ui.item.longitude;	
		
		document.getElementById("geocodedAddress").innerHTML="Loading...";
        var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
		google.maps.event.addListener(map,'center_changed',function(){
			//alert("all tiles loaded !");								
			document.getElementById("loading").style.display="";			
		});			
		google.maps.event.addListener(map,'tilesloaded',function(){
			//alert("all tiles loaded !");								
			document.getElementById("loading").style.display="none";		
		});
        marker.setPosition(location);
        map.setCenter(location);
		map.setZoom(16);
		document.getElementById("geocodedAddress").innerHTML=ui.item.value;
      }
    });
  });
	
  //Add listener to marker for reverse geocoding
  google.maps.event.addListener(marker, 'dragstart', function() {
	document.getElementById("loading").style.display="";
  });
  
  
  google.maps.event.addListener(marker, 'dragend', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
		document.getElementById("geocodedAddress").innerHTML="Loading...";
          $('#nearestAddress').val(results[0].formatted_address);		
        //  $('#latitude').val(marker.getPosition().lat());
		//  $('#longitude').val(marker.getPosition().lat());
		
		latitude=marker.getPosition().lat();
		longitude=marker.getPosition().lng();	
		document.getElementById("geocodedAddress").innerHTML=results[0].formatted_address;
		document.getElementById("loading").style.display="none";
          
        }
      }
    });
  }
  );
  
});


function get_typed_address_latlng(){
	geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
		document.getElementById("geocodedAddress").innerHTML="Loading...";
          $('#nearestAddress').val(results[0].formatted_address);		
        //  $('#latitude').val(marker.getPosition().lat());
		//  $('#longitude').val(marker.getPosition().lat());
		
		latitude=marker.getPosition().lat();
		longitude=marker.getPosition().lng();	
		document.getElementById("geocodedAddress").innerHTML=results[0].formatted_address;
		document.getElementById("loading").style.display="none";
          
        }
      }
    });
}
	var isFileUploaded=false;
	var only_filename="";
	
	var isItemNameValid=false
	var isPriceValid=false;
	//var isShopNameValid=false;
	var isNearestAddressValid=false;
	

	function save(){
		

		//do validation check for all input fields
		validateAll();
		
		if(isFileUploaded==true && isItemNameValid==true && isPriceValid==true &&  isNearestAddressValid==true){
			//alert("now u can save in db");
		
			var itemNameValue=trim($("#itemName").val());
			var photoFileNameValue=only_filename;
			var priceValue=trim($("#price").val());
			var shopNameValue=trim($("#shopName").val());
			var geocodedAddressValue=trim(document.getElementById("geocodedAddress").innerHTML).toString();
			var currency=trim($("#currency").val());
		//	alert(currency);
			//alert(itemNameValue+","+photoFileNameValue+","+priceValue+","+shopNameValue+","+geocodedAddressValue);
		
			document.getElementById('saveBtn').value='Saving...Please Wait...';
			xmlhttpPost("saveInDB.php",itemNameValue,photoFileNameValue,priceValue,currency,shopNameValue,geocodedAddressValue,latitude,longitude,sess_member_id);
			
		}
		else{
			alert("Please fill all fields correctly.");	//alert("isFileUploaded="+isFileUploaded+",isItemNameValid="+isItemNameValid+",isPriceValid="+isPriceValid+",isNearestAddressValid="+isNearestAddressValid);
		}
	}

	
		
	function xmlhttpPost(strURL,itemNameValue,photoFileNameValue,priceValue,currency,shopNameValue,geocodedAddressValue,latitude,longitude,sess_member_id) {
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
		self.xmlHttpReq.send("itemNameValue="+itemNameValue+"&photoFileNameValue="+photoFileNameValue+"&priceValue="+priceValue+"&shopNameValue="+shopNameValue+"&currency="+currency+"&geocodedAddressValue="+geocodedAddressValue+"&latitude="+latitude+"&longitude="+longitude+"&sess_member_id="+sess_member_id);
	}
	
	function updatepage(str){
		//alert(str);
		if(str=='1'){
			alert('Item adeded successfully!');
			document.getElementById('saveBtn').value='Save';
		}
		else{
			alert('Adding Item Failed,try again!');
			document.getElementById('saveBtn').value='Oops ! could not save. Try again.';
		}
	//	document.getElementById("saveResponse").innerHTML=str;
	}

	function validateAll(){	
		//1. check for image filename
		validateFileName();
		
		//2. check whether item Name is Blank
		validateItemName();		
		
		//3. check whether price is valid
		validatePrice();	
		
		//4. check for shop name
		var shopName=trim($("#shopName").val());

		//5. check for nearest address
		validateNearestAddress();			
	}

	function validateNearestAddress(){		
		var nearestAddress=trim(document.getElementById("nearestAddress").value);		
		if(nearestAddress.length==0){
			isNearestAddressValid==false;
			document.getElementById("address_validate").style.display="";
			document.getElementById("address_validate").innerHTML="Enter nearest address";
		}
		else{
			isNearestAddressValid=true;
			document.getElementById("address_validate").innerHTML="";
		}
	}

	function validatePrice(){
		var price=trim($("#price").val());
		if(price.length>0){
			if(price<1 || price>9999999){
				isPriceValid=false;
				document.getElementById("price_validate").style.display="";
				document.getElementById("price_validate").innerHTML="Price range is 1 to 9999999.";
			}else if(digit_test(price)==false){
				isPriceValid=false;
				document.getElementById("price_validate").style.display="";
				document.getElementById("price_validate").innerHTML="Price can have only digits.";
			}
			else{
				isPriceValid=true;
				document.getElementById("price_validate").style.display="";
				document.getElementById("price_validate").innerHTML="";
			}
		}
		else{
			isPriceValid=false;
			document.getElementById("price_validate").style.display="";
			document.getElementById("price_validate").innerHTML="Enter price";
		}
	}
	
	
	function validateItemName(){
		var itemName=trim($("#itemName").val());		
		if(itemName.length>=3){	
			if(digit_test(itemName)==true){
				isItemNameValid=false;
				document.getElementById("itemName_validate").style.display="";
				document.getElementById("itemName_validate").innerHTML="Name cannot be all numbers.";
			}
			else{
				isItemNameValid=true;
				document.getElementById("itemName_validate").innerHTML="";
			}
		}
		else if(itemName.length>0 && itemName.length<3){
				isItemNameValid=false;
				document.getElementById("itemName_validate").style.display="";
				document.getElementById("itemName_validate").innerHTML="Atleast 3 characters.";
		}
		else{
			isItemNameValid=false;			
			document.getElementById("itemName_validate").style.display="";
			document.getElementById("itemName_validate").innerHTML="Enter Name";
		}		
	}
	
	
	function validateFileName(){
		
		var fullpath_filename=document.getElementById("item_photo").src;//trim($("#filename").val());
		if(fullpath_filename.length>0){
			only_filename =fullpath_filename.substring(fullpath_filename.lastIndexOf('/')+1);//fullpath_filename.replace(/^.*\\/, '');
		//	alert(only_filename);
			isFileUploaded=true;
			document.getElementById("filename_validate").innerHTML="";
		}
		else{
			isFileUploaded=false;
			document.getElementById("filename_validate").style.display="";
			document.getElementById("filename_validate").innerHTML="Upload Items Photo";
		}	
	}
	
	
	function digit_test(str) {
            return /^ *[0-9]+ *$/.test(str);
        }
		
	
function itemName_KeyUp(event){
	if(event.keyCode!='9' && event.keyCode!='16')
		validateItemName();
}

function price_KeyUp(event){
	if(event.keyCode!='9' && event.keyCode!='16')
		validatePrice();
}


function nearestAddress_KeyUp(event){
	
	if(event.keyCode=='13'){
		loadAddress();
	}
	
	if(event.keyCode!='9' && event.keyCode!='16')
		validateNearestAddress();
}


function ltrim(str) { 
	for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
	return str.substring(k, str.length);
}
function rtrim(str) {
	for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ;
	return str.substring(0,j+1);
}
function trim(str) {
	return ltrim(rtrim(str));
}
function isWhitespace(charToCheck) {
	var whitespaceChars = " \t\n\r\f";
	return (whitespaceChars.indexOf(charToCheck) != -1);
}