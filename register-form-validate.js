var fullname_isValid=false;
	var email_isValid=false;
	var password_isValid=false;
	
	function getEMailMsg(value,event){
		if(event.keyCode!=9 && event.keyCode!=16){
			document.getElementById("registerMsg").innerHTML="";
			if(value.length==0){
				document.getElementById("emailMsg").innerHTML="<b>Email cannot be blank !</b>";
			}else{
				xmlhttpPost_email("getEmailMsg.php",value);
			}
		}
	}
	
	function getFullNameMsg(value,event){	
		if(event.keyCode!=9 && event.keyCode!=16){
			document.getElementById("registerMsg").innerHTML="";
			if(value.length==0){
				document.getElementById("fullnameMsg").innerHTML="<b>Name cannot be blank !</b>";
				fullname_isValid=false;
			}
			else if(value.length>30){
				document.getElementById("fullnameMsg").innerHTML="<b>Name should be less than 30 characters in length.</b>";
				fullname_isValid=false;
			}
			else{				
				document.getElementById("fullnameMsg").innerHTML="";
				fullname_isValid=true;
			}
		}
	}
	
	function getPasswordMsg(value,event){
		if(event.keyCode!=9 && event.keyCode!=16){
			document.getElementById("registerMsg").innerHTML="";
			if(value.length<8){
				document.getElementById("passwordMsg").innerHTML="<b>Password should be atleast 8 characters in length.!</b>";
				password_isValid=false;
			}
			else{
				document.getElementById("passwordMsg").innerHTML="";
				password_isValid=true;
			}
		}
	}
	
	function xmlhttpPost_email(strURL,value) {
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
					if(receivedMsg=="1"){
						document.getElementById("emailMsg").innerHTML="<b>"+"email correct."+"</b>";
						email_isValid=false;
					}
					else if(receivedMsg=="4"){
						document.getElementById("emailMsg").innerHTML="<b>"+"Invalid EMail."+"</b>";
						email_isValid=false;
					}
					else if(receivedMsg=="12"){
						document.getElementById("emailMsg").innerHTML="<b>"+"email ID already in use"+"</b>";
						email_isValid=false;
					}
					else if(receivedMsg=="13"){
						document.getElementById("emailMsg").innerHTML="<b>"+"email will be send to you for verification."+"</b>";
						email_isValid=true;
					}				
	        }
	    }		
		self.xmlHttpReq.send("email="+value);
	}
	
	function xmlhttpPost_register(strURL,fullname,email,password) {
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
				if(receivedMsg=="1"){
					document.getElementById("registerBtn").value="Register";
					document.getElementById("registerMsg").innerHTML="<b>"+"Registration Successful ! An email has been send to you.<br/>Please verify your email account."+"</b>";
					document.getElementById("fullname").value="";
					document.getElementById("email").value="";
					document.getElementById("password").value="";
					document.getElementById("emailMsg").value="";
				}
				else {
					document.getElementById("registerMsg").innerHTML="<b>"+"Oops ! something went wrong. Please register again."+"</b>";
				}
	        }
	    }		
		self.xmlHttpReq.send("fullname="+fullname+"&email="+email+"&password="+password);
	}
	
	function check(){
		if(fullname_isValid==true && password_isValid==true && email_isValid==true ){
			//alert("registering.....");
			var fullname=document.getElementById("fullname").value;
			var email=document.getElementById("email").value;
			var password=document.getElementById("password").value;
		//	alert(fullname+","+email+","+password);
			document.getElementById("registerBtn").value="Please Wait...";
			xmlhttpPost_register("execute_registration.php",fullname,email,password);
			document.getElementById("fullname").value="";
			document.getElementById("email").value="";
			document.getElementById("password").value="";
			document.getElementById("emailMsg").value="";
		}
		else{
	//	alert(email_isValid+","+password_isValid+","+fullname_isValid);
//alert("not ready as email_isValid="+email_isValid+",password_isValid="+password_isValid+",fullname_isValid="+fullname_isValid);
		}		

	}
	