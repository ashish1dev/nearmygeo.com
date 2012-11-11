<link href='http://www.nearmygeo.com/style_main.css' rel='stylesheet' type='text/css' />

<LINK REL="image_src" HREF="http://www.nearmygeo.com/logo4_smaller_est.png" type="image/png"/>
<LINK REL="SHORTCUT ICON" HREF="http://www.nearmygeo.com/new_icon.ico"  type="image/x-icon"/>
<title>
NearMyGeo.com | Follow addresses. Share item&rsquo;s info with address followers. 
</title>
<meta name='description' content='Follow addresses. Bought an item ? share this info with followers of its shop&rsquo;s address.' />
<meta name='keywords' content='follow address,follow addresses,share info,nearmygeo.com,nearmygeo,near my area,in my area'/>

<meta property="og:title" content="NearMyGeo.com"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://nearmygeo.com"/>
    <meta property="og:image" content="http://www.nearmygeo.com/logo4_smaller_est.png"/>
    <meta property="og:site_name" content="NearMyGeo.com"/>
    <meta property="og:description"
          content="Follow addresses. Bought an item ? share this info with followers of its shop&rsquo;s address."/>
	<meta property="fb:admins" content="609316041" />
		  

<?php include_once("analyticstracking.php") ?>

<?php

echo "<img src='http://www.nearmygeo.com/logo4.png' align='left' width='200px' height='50px'/>";
echo "<br/><b><span style='clear:both;padding:20px;float:left;'>Howdy <u>".$_SESSION['SESS_FULL_NAME']."</u> !</span>";

echo "<a href='http://www.nearmygeo.com/home.php' style='float:left;padding:20px;'>Home</a>";

echo "<a href='http://www.nearmygeo.com/followLocation.php' style='float:left;padding:20px;border-left:1px solid;'>Follow Locations</a>";

echo "<a href='http://www.nearmygeo.com/addItemToLocation/addItemToLocation.php' style='float:left;padding:20px;border-left:1px solid;'>Add Item to Location</a>";

echo "<a href='http://www.nearmygeo.com/showItems/showItems.php' style='float:left;padding:20px;border-left:1px solid;'>Show All Items</a>";
 
echo "<a href='http://www.nearmygeo.com/showItems/myItems.php' style='float:left;padding:20px;border-left:1px solid;'>My Uploads</a>";

echo "<a href='http://www.nearmygeo.com/logout.php' style='float:left;padding:20px;border-left:1px solid;'>Logout</a></b>";

echo "<br/><br/>";
?>
