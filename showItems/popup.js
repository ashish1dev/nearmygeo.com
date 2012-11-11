/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		popupStatus = 0;
	}
}



//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	
	var popupTop=document.body.scrollTop+50;
	
	//adjustment for IE
	if(windowWidth==0 && windowHeight==0){
		windowHeight=document.body.clientHeight;
		windowWidth=document.body.clientWidth;
	}
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "absolute",
		//"top": windowHeight/2-popupHeight/2,
		"top":popupTop,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
	//	"height": windowHeight	
		"height": 	$(document).height(),	
		"width": 	$(document).width()
	});

}


//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	
	//LOADING POPUP
	//Click the button event!
	/*$("#button").click(function(){
		
		//centering with css
		centerPopup(mouseClickY);
		//load popup
		loadPopup();
	});
	*/
				
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

});




var count=0;
var map;
var marker;
var latlng;
var infowindow;
var contentString;

function popupWindow( lat, lng, strtitle){
		
		if(count==0){
			initializeMapPopup(lat,lng);			
		}
		else{
		marker.setMap(null);
		}
//alert('2');		
		latlng=new google.maps.LatLng(lat,lng);
		document.getElementById('popupMapTitle').innerHTML=strtitle;
		 marker = new google.maps.Marker({		
						position: latlng,
						map: map, 		
						title:strtitle		});  
	//	alert('3');		
		contentString="<div style='color:#223B5B;'>"+strtitle+"</div>";
		infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		infowindow.open(map,marker);
		setTimeout(function () { infowindow.close(); }, 3000);

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
	
		
		map.setCenter(latlng);
		centerPopup();
		//load popup
		loadPopup();
		count++;	
//	alert('3');		
}
  function initializeMapPopup(lat,lng) {
     latlng = new google.maps.LatLng(lat,lng);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
     map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
		
	
	//	alert(map);
  }


