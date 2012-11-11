<?php
	

?>
<html>
<head>

<LINK REL="image_src" HREF="http://www.nearmygeo.com/logo4_smaller_est.png" type="image/png"/>
<LINK REL="SHORTCUT ICON" HREF="http://www.nearmygeo.com/new_icon.ico"  type="image/x-icon"/>
<title>
NearMyGeo.com | Follow addresses. Share item&rsquo;s info with address followers. 
</title>
<meta name='description' content='Follow addresses. Bought an item ? share this info with followers of its shop&rsquo;s address.'/>


<meta name='keywords' content='follow address,follow addresses,share info,nearmygeo.com,nearmygeo,near my area,in my area' />
 

<script src="login-validate.js"></script>
<script src="register-form-validate.js"></script>
<style>
.smallText{font:11px arial,sans-serif;color:red;}
.registerMsg{font:16px arial,sans-serif;color:white;}
</style>
<link href='http://nearmygeo.com/style_main.css' rel='stylesheet' type='text/css'/>


<meta property="og:title" content="NearMyGeo.com"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://nearmygeo.com"/>
    <meta property="og:image" content="http://www.nearmygeo.com/logo4_smaller_est.png"/>
    <meta property="og:site_name" content="NearMyGeo.com"/>
    <meta property="og:description"
          content="Follow addresses. Bought an item ? share this info with followers of its shop&rsquo;s address."/>
	<meta property="fb:admins" content="609316041" />
</head>
<body>

<?php include_once("analyticstracking.php") ?>


<img src='http://www.nearmygeo.com/logo4.png' align='left' width='350px' height='100px'/><br/>

<div id='tagline' style='clear:both;margin-top:60px;margin-left:100px;' >

<font style='font-size:22px;font-weight:bold;'>Follow an address.Get updates about items being sold at that address.</font>
<br/>
<font style='clear:both;font-size:20px;'>Bought an item ? share this info with followers of its shop&rsquo;s address.</font>

</div>

<div style='margin-top:50px;'>
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



<div style="float:left;margin-left:60px;border-left:1px solid white;height:120px;font:11px arial,sans-serif;"></div>


<form name="register" action="javascript:check();" >
  <table width="450" border="0"  cellpadding="2" cellspacing="0"  style='float:left;vertical-align:top;margin-left:60px;'>
  <tr colspan='2'><td><font size=3><u>Register</u></font></td></tr>
	<tr>
	<td align="left">Full Name:</td>
	<td><input name="fullname" type="text" class="textfield" id="fullname" onkeyup="getFullNameMsg(this.value,event)"/></td>	
	<td width="400" ><label id="fullnameMsg" name="fullnameMsg" class="smallText"></td>
	</tr>
    
	<tr>
      <td width="124" align="left">EMail:</td>
      <td width="168"><input name="email" type="text" class="textfield" id="email" onkeyup="getEMailMsg(this.value,event)"/></td>
	  <td width="400"><label id="emailMsg" name="emailMsg" class="smallText"/></td>
    </tr>

	<tr>
      <td align="left">Password:</td>
      <td><input name="password" type="password" class="textfield" id="password"  onkeyup="getPasswordMsg(this.value,event)"/></td>
	  <td width="400"><label id="passwordMsg" name="passwordMsg"  class="smallText"/></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit" id="registerBtn" value="Register" onclick="check()" /></td>
    </tr>
	<tr><td colspan="3"><label id="registerMsg" name="registerMsg" class="registerMsg"/></td></tr>
  </table>
</form>

</div>

<!--
<div id="fb-root" style="clear:both;float:left;margin-left:60px;margin-top:80px;"></div><script src="http://connect.facebook.net/en_US/all.js#appId=265338033484042&amp;xfbml=1"></script><fb:like href="http://nearmygeo.com" send="false" layout="button_count" width="70" show_faces="true" font="lucida grande"></fb:like>

<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
-->
</body>
</html>

<?php echo "<span style='clear:both;float:left;margin-top:300px;'>";
echo "</span>";
include('footer.php');

?> 