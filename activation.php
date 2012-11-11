<link href='http://www.nearmygeo.com/style_main.css' rel='stylesheet' type='text/css' />
<LINK REL="SHORTCUT ICON" HREF="http://www.nearmygeo.com/new_icon.ico"  type="image/x-icon"/>
<title>
NearMyGeo.com | Follow addresses. Share item&rsquo;s info with address followers. 
</title>
<img src='http://www.nearmygeo.com/logo4.png' align='left' width='200px' height='50px'/>

<?php
//Include database connection details
	require_once('config.php');
	echo "<div style='clear:both;float:left;margin-top:60px;margin-left:100px;'></div><br/><br/>";
	
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = $_GET['email'];
}

if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
 //The Activation key will always be 32 since it is MD5 Hash
 {
 $key = $_GET['key'];
}

//echo $email.",".$key."<br/>";



	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
if (isset($email) && isset($key)) {

 // Update the database to set the "activation" field to null

 $query_activate_account = "UPDATE registered_users SET activation=NULL WHERE(email ='$email' AND activation='$key')LIMIT 1"; 
 $result_activate_account = mysql_query($query_activate_account);

 // Print a customized message:
 if (mysql_affected_rows($link) == 1) //if update query was successfull
 {
	echo '<br/>Your account is now <b>active</b>. Go ahead and Log in</a>';?>
 

 <!--
 <table>
 <tr><td colspan="2">Login</td></tr>
 <tr>
	<td>E-Mail:</td>
	<td><input type="text" id="login_email" name="login_email"/></td>
	<td><label id="emailMsg"/></td>
 </tr>
 <tr>
	<td>Password:</td>
	<td><input type="password" id="login_password" name="login_password"/></td>
	<td><label id="passwordMsg"/></td>
 </tr>
 <tr>
	<td><input type="submit" value="Get In ! " onClick="validate()"/></td>
	<td><label id="validateMsg" name="validateMsg"/></td>
 </tr>
 </table>
 -->
 <script src="login-validate.js"></script>
 <form name="login" action="javascript:validate();" style='clear:left;float:left;margin-left:180px;'>
<table  border='0'> 
 <tr><td colspan="2" ><font size=3><u>Login</u></font></td></tr>
 <tr>
	<td>Email:</td>
	<td><input type="text" id="login_email" name="login_email"/></td>
	<td><label id="login_emailMsg" class="smallText"></label></td>
 </tr>
 <tr>
	<td>Password:</td>
	<td><input type="password" id="login_password" name="login_password"/></td>
	<td><label id="login_passwordMsg" class="smallText"></label></td>
 </tr>
 <tr>
	<td><input type="submit" value="Sign In" id="signinBtn" onClick="validate()"/></td>
	<td colspan='2'><label id="login_validateMsg" name="login_validateMsg" class="smallText"></label></td>
 </tr>
 </table> 
</form>
 <?

 } else {
 	$query= "SELECT email from registered_users WHERE email='$email'";
	$result=mysql_query($query);
	$row = mysql_fetch_assoc($result);
	
	if($row['email']==NULL){
		echo "<br/><br/>The email address ".$email ." has not been registered with us. Please register.";	
	}
	else if($row['email']!=NULL && $row['activation']==NULL){
		
		?>
		<script src="login-validate.js"></script>
		<form name="login" action="javascript:validate();" style='clear:left;float:left;margin-left:180px;'>
		<?
		echo "Account for email ".$email." has already been activated. Go ahead and login.";
		?>
		<table  border='0'> 
		<tr><td colspan="2" ><font size=3><u>Login</u></font></td></tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" id="login_email" name="login_email"/></td>
			<td><label id="login_emailMsg" class="smallText"></label></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" id="login_password" name="login_password"/></td>
			<td><label id="login_passwordMsg" class="smallText"></label></td>
		</tr>
		<tr>
			<td><input type="submit" value="Sign In" id="signinBtn" onClick="validate()"/></td>
			<td colspan='2'><label id="login_validateMsg" name="login_validateMsg" class="smallText"></label></td>
		</tr>
		</table> 
		</form>
		
		<?
	}
 }

 mysql_close($link);

} else {
 echo "<div style='clear:both;float:left;margin-top:20px;margin-left:100px;font-size:18'>This activation link is incorrect.</div>";
}


?>