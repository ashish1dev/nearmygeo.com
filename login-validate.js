
 
 function validate(){
	document.getElementById("signinBtn").value="Please Wait...";
	var email=document.getElementById("login_email").value;	
	var password=document.getElementById("login_password").value;	
	if(email.length==0){
		document.getElementById("login_validateMsg").innerHTML="<b>email missing.</b>";
		document.getElementById("signinBtn").value="Sign In";
	}
	else{
		//document.getElementById("login_validateMsg").innerHTML="";
	}
	if(password.length==0){
		document.getElementById("login_validateMsg").innerHTML="<b>password missing.</b>";
		document.getElementById("signinBtn").value="Sign In";
	}else{
	//	document.getElementById("login_validateMsg").innerHTML="";
	}	
	if(email.length>0 && password.length>0){
		
		xmlhttpPost_validate("login-authenticate.php",email,password);
		document.getElementById("signinBtn").value="Sign In";
	}
  }
  function xmlhttpPost_validate(strURL,email,password) {
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
				if(receivedMsg=='1'){
					
					window.location.href="home.php";				
				}
				else if(receivedMsg=='3'){
					document.getElementById("login_validateMsg").innerHTML="You have not yet activated your <br/> account.Please click the activation <br/> link send to your email address.";
				}
				else{
				document.getElementById("login_validateMsg").innerHTML="Invalid ! Think harder,Try again. ";
			
				}
	        }
	    }
		self.xmlHttpReq.send("email="+email+"&password="+password);
	}