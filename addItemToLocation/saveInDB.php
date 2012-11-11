<?php

include'../config.php';




$itemNameValue=htmlspecialchars($_POST['itemNameValue'],ENT_QUOTES);
$photoFileNameValue=htmlspecialchars($_POST['photoFileNameValue'],ENT_QUOTES);
$priceValue=$_POST['priceValue'];
$shopNameValue=htmlspecialchars($_POST['shopNameValue'],ENT_QUOTES);
$currency=$_POST['currency'];
$geocodedAddressValue=htmlspecialchars($_POST['geocodedAddressValue'],ENT_QUOTES);
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$sess_member_id=$_POST['sess_member_id'];
/*
echo 'ReceivedValues : ';

echo ' itemNameValue='.$itemNameValue;
echo ' photoFileNameValue='.$photoFileNameValue;
echo ' priceValue='.$priceValue;
echo ' shopNameValue='.$shopNameValue;
echo ' geocodedAddressValue='.$geocodedAddressValue;
echo ' latitude='.$latitude;
echo ' longitude='.$longitude;
*/

insert($photoFileNameValue,$itemNameValue,$priceValue,$currency,$shopNameValue,$geocodedAddressValue,$latitude,$longitude,$sess_member_id);


function insert($photoFileNameValue,$itemNameValue,$priceValue,$currency,$shopNameValue,$geocodedAddressValue,$latitude,$longitude,$sess_member_id){
	$queryStr="SELECT addr_id,street_address from addresses WHERE street_address ='$geocodedAddressValue'";
	//echo 'query = '.$queryStr;
	$checkDuplicateAddress=mysql_query($queryStr);
	
	//if already present, get the addr_id and move forward to next step.
	$num=mysql_num_rows($checkDuplicateAddress);
	//echo 'num = '.$num.'<br/>';
	if($num>0){
		$row=mysql_fetch_object($checkDuplicateAddress);
		$address_id=$row->addr_id;
		//echo 'duplicate found...with addr id = '.$address_id;
	}
	else{
		
		$addressSQL=mysql_query("INSERT INTO addresses (street_address,lat,lng) VALUES ('$geocodedAddressValue','$latitude','$longitude')");
		$address_id=mysql_insert_id();
		//echo 'new address added...';
	}
	
	
	
	$itemSQL=mysql_query("INSERT INTO item (item_photo,item_name,item_price,currency,shop_name,address_id,uploaded_by_user_id) VALUES ('$photoFileNameValue','$itemNameValue',$priceValue,'$currency','$shopNameValue',$address_id,'$sess_member_id');");
	if(!$itemSQL){
		mysql_error();
	//echo 0;
	}
	else
	{
	//echo 'Item Inserted into items table successfully!';
	
	//send an email to administrator
	$to_email='ashish.fagna@gmail.com';
	$from_email='contact@nearmygeo.com';
	$message='A new item has beenuploaded on nearmygeo.com, please check the apprval page http://www.nearmygeo.com/admin/approval.php <br/>
	Thanks,<br/>
	NearMyGeo.com';
		mail($to_email, 'Awaiting approval', $message, 'From:'.$from_email);
	echo 1;
	}
}

?>