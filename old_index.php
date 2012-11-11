<?php

?>
<html>
<head>
<script src="login-validate.js"></script>
</head>

<body>

 <table style='float:left;'> 
 <tr><td colspan="2">Login</td></tr>
 <tr>
	<td>Email</td>
	<td><input type="text" id="login_email" name="login_email"/></td>
	<td><label id="emailMsg"></label></td>
 </tr>
 <tr>
	<td>password</td>
	<td><input type="password" id="login_password" name="login_password"/></td>
	<td><label id="passwordMsg"></label></td>
 </tr>
 <tr>
	<td><input type="submit" value="Get In ! " onClick="validate()"/></td>
	<td><label id="validateMsg" name="validateMsg" style='color:red'></label></td>
 </tr>
 </table>
 
<div style="float:left;margin-left:40px;border-left:1px solid #000;height:100px"></div>

 <h3><a href='register-form.php' style='float:left;vertical-align:top;margin-left:40px;'>Register</a></h3>

</body>
</html>
 