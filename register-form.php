<?php
	session_start();
	echo "<h1>NearMyGeo</h1>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<script src="register-form-validate.js"></script>
<style>
.smallText{font-size:10px;}
</style>
</head>
<body>
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
<form id="loginForm" name="loginForm" method="post" action="">
  <table width="450" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#ffffff">
  <tr colspan='2'><td><b><u>Register</u></b></td></tr>
	<tr>
	<th align="left">Full Name:</th>
	<td><input name="fullname" type="text" class="textfield" id="fullname" onkeyup="getFullNameMsg(this.value,event)"/></td>	
	<td width="400" ><label id="fullnameMsg" name="fullnameMsg" class="smallText"></td>
	</tr>
    
	<tr>
      <th width="124" align="left">EMail:</th>
      <td width="168"><input name="email" type="text" class="textfield" id="email" onkeyup="getEMailMsg(this.value,event)"/></td>
	  <td width="400"><label id="emailMsg" name="emailMsg" class="smallText"/></td>
    </tr>

	<tr>
      <th align="left">Password:</th>
      <td><input name="password" type="password" class="textfield" id="password"  onkeyup="getPasswordMsg(this.value,event)"/></td>
	  <td width="400"><label id="passwordMsg" name="passwordMsg"  class="smallText"/></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit" value="Register" onclick="check()" /></td>
    </tr>
	<tr><td colspan="3"><label id="registerMsg" name="registerMsg" class="registerMsg"/></td></tr>
  </table>
</form>
</body>
</html>